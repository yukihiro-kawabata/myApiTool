<?php

namespace App\Http\Controllers;

use Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

use App\db\cash;
use App\db\kamoku_mst;

use App\Model\cash\cashModel;
use App\Model\cash\view_cash_list_model;

class cashController extends Controller
{
    private $userDatas = ['share', 'kabigon', 'yukihiro', 'other'];

    public function indexAction()
    {
        $request = Request::all();

        $kamoku_mstDao = new kamoku_mst();
        $kamokuDatas = $kamoku_mstDao->orderBy('priority_flg', 'DESC')->get();

        return view('script.cash.index')->with([
            "userDatas" => $this->userDatas,
            "kamokuDatas" => $kamokuDatas,
        ]);
    }

    public function indexexecute()
    {
        $request = Request::all();

    	$array = [
            'name'      => '名前',
            'price'     => '金額',
            'date'      => '日時',
            'comment'   => '概要',
            'kamoku_id' => '勘定科目',
        ];

        $cashDao = new cash();

        // 入力値をチェック
        foreach ($array as $col => $val) {
            if (empty($request[$col])) dx($val . 'が足りません');
            // データ登録準備
            $cashDao->{$col} = $request[$col];
        }

        // tagに勘定科目を入れる
        $kamoku_mstDao = new kamoku_mst();
        $tag = $kamoku_mstDao->where('kamoku_id', $request['kamoku_id'])->get()->first();
        $cashDao->tag = $tag['kamoku'];

        // データ登録
        $cashDao->save();
    
        return redirect(url('/cash/list'));
    }

    /*
     * 一覧画面
     */ 
    public function listAction()
    {
        $request = Request::all();

        if (!array_key_exists('date', $request)) $request['date'] = date('Ym');

        $view_cash_list_model = new view_cash_list_model();

        $view = $view_cash_list_model->view_list($request);

        return view('script.cash.list')->with([
            "view" => $view,
            "request" => $request,
        ]);
    }

}
