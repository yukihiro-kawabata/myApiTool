<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\db\item;

class apiController extends Controller
{
    private $required_col_cnt = 10; // maximum number of required column for API
    // private $param_col_cnt = 30;    // maximun number of API parameters
    private $param_col_cnt = 10;    // maximun number of API parameters <- DB is up to 30, but set to 10 temporarily
    private $group_by_col_cnt = 10;

    /*
     * registration screen
     */
    public function indexAction()
    {
        $request = Request::all();

        // edit mode
        $item = [];
        if (array_key_jug('id', $request)) {
            $itemDao = new item();
            $item = $itemDao->where('id', $request['id'])->first();
        }

        if (empty($item)) {
            $itemCols = Schema::getColumnListing('item');
            foreach ($itemCols as $itemNum => $itemCol) {
                if (!array_key_exists($itemCol, $item)) $item[$itemCol] = '';
            }
        }

        $dbContant = config('database')["connections"];

        return view('script.regist')->with([
            'required_col_cnt' => $this->required_col_cnt,
            'param_col_cnt'    => $this->param_col_cnt,
            'group_by_col_cnt' => $this->group_by_col_cnt,
            'dbContant'        => $dbContant, // DB infomation described in env file
            'item'             => $item,
        ]);
    }

    /*
     * registration process of api OR update process of api
     */
    public function indexexecute()
    {
        $request = Request::all();

        // validation of required item
        $require_array = ['api_name', 'db_name', 'db_table', 'db_table_col'];
        foreach ($require_array as $require_key) {
            if (empty($request[$require_key])) return 'Not Found "' . $require_key . '"';
        }

        $itemDao = new item();
        if (empty($request['id'])) {
            // all attributes must be specified
            foreach($request as $key => $val) { $itemDao->{$key} = $val; }
            $itemDao->save();
        } else {
            $itemDao->where('id', $request['id'])->update($request);
        }

        // jump to document page
        return redirect(url('/doc') . '?api_name=' . $request['api_name']);
    }

    /*
     * registration screen
     */
    public function docAction()
    {
        $request = Request::all();
        if (!array_key_exists('api_name', $request)) $request['api_name'] = '';
    
        // api_name is unique
        $apiData = (object)[];
        $itemDao = new item();
        $apiDatas = $itemDao->getDataByApiName($request['api_name']);
        if (!empty($apiDatas)) {
            $apiData = $apiDatas[0];
        } else {
            $itemCols = Schema::getColumnListing('item');
            foreach ($itemCols as $itemNum => $itemCol) {
                $apiData->{$itemCol} = '';
            }
        }

        // get all api_name
        $allApiNames = $itemDao->getDataAllApiName();

        return view('script.doc')->with([
            "apiData"          => $apiData,     // user requested api name
            "allApiNames"      => $allApiNames, // all api name
            'required_col_cnt' => $this->required_col_cnt,
            'param_col_cnt'    => $this->param_col_cnt,            
            'group_by_col_cnt' => $this->group_by_col_cnt,
        ]);
    }

    /*
     * basic API URL
     */
    public function apiAction()
    {
        $request = Request::all();

        array_key_jug('action', $request, 'Not Found "action"');

        $itemDao = new item();
        $item = $itemDao->where('api_name', $request['action'])->first();

        // array of API Search. key: search parameter, value: search value
        $search = [];

        // validate request if required
        for ($reqCnt = 1; $reqCnt <= $this->required_col_cnt; $reqCnt++) {
            if (!empty($item['required'.$reqCnt])) {
                if (!array_key_exists($item['required'.$reqCnt], $request)) {
                    return 'Not Found "' . $item['required'.$reqCnt] . '"';
                } else {
                    $search[$item['required'.$reqCnt]] = $request[$item['required'.$reqCnt]];
                }
            }
        }

        // other parameters
        for ($paramCnt = 1; $paramCnt <= $this->param_col_cnt; $paramCnt++) {
            if (!empty($item['param'.$paramCnt]) && array_key_exists($item['param'.$paramCnt], $request)) {
                $search[$item['param'.$paramCnt]] = $request[$item['param'.$paramCnt]];
            }
        }

        // group by
        $groupBySql = '';
        for ($groupbyCol = 1; $groupbyCol <= $this->group_by_col_cnt; $groupbyCol++) {
            if (!empty($item['group_by'.$groupbyCol]) && array_key_exists($item['group_by'.$groupbyCol], $request)) {
                if (empty($groupBySql)) $groupBySql = " GROUP BY ";
                $groupBySql .= $item['group_by'.$groupbyCol] . ',';
            }
        }
        // Removed because it contains an extra comma at the end
        $groupBy = preg_replace('/,$/', '', $groupBySql);

        $db_exists_flg = false;
        foreach (config('database')["connections"] as $dbClass => $dbcontant) {
            if ($dbClass === $item['db_name']) {
                $db_exists_flg = true;
                break;
            }
        }
        if (!$db_exists_flg) return "Target DB configuration not found in env file";

        // summarize the SQL
        $sql  = "SELECT " . $item['db_table_col'];
        $sql .= " FROM "  . $item['db_table'];
        $where = []; $i = 0;
        foreach ($search as $key => $val) {
            if ($i === 0) {
                $sql .= " WHERE ";
            } else {
                $sql .= " AND ";
            }
            $sql .= $key . " LIKE '" . $val . "'";
            $i++;
        }
        if (!empty($groupBy)) $sql .= " $groupBy";
        return DB::connection($item['db_name'])->select($sql);
    } 

}