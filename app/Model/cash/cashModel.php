<?php

namespace App\Model\cash;

use Illuminate\Database\Eloquent\Model;

use App\db\cash;

class cashModel extends Model
{
    private $devit_limit_day = 15;

    /*
     * 一覧で使用する集計科目ごとのサマリーデータ
     * @param array $date 指定年月 ex). 2019-12
     */
    public function sum_kamoku_list($date) : array
    {
        if (empty($date) || mb_strlen($date) !== 6) $date = date('Ym');

        $year  = preg_replace('/\d{2}$/', '', $date);
        $month = preg_replace('/^\d{4}/', '', $date);

        $cashDao = new cash();
        $cashDatas = $cashDao->fetch_kamoku_sum_price("$year-$month");
        $viewDatas = [];
        foreach ($cashDatas as $cashDataNum => $cashData) {
            $view = [];
            $view['kamoku_sum'] = $cashData->kamoku_sum;
            $view['amount']     = number_format((int)$cashData->amount);
            $view['amount_flg'] = $cashData->amount_flg;
            $viewDatas[] = $view;
        }
        return $viewDatas;
    }

    /*
     * 現在の残高を取得する
     * @return int $re 残高
     */
    public function sum_balance() : int
    {
        $re= 0;

        $cashDao = new cash();
        $sum_balance = $cashDao->sum_balance();
        foreach ($sum_balance as $num => $balance) {
            $re = $re + $balance->balance; // クエリで支出はマイナスで取得するようにしたので単純に足し算すればOK
        }
        return $re;
    }
    
    /*
     * 現在のデビットカードの使用金額を取得する
     * @param int $date yyyymm形式の年月
     */ 
    public function card_pay_fee(int $date) : int
    {
        if (empty($date) || mb_strlen($date) !== 6) $date = date('Ym');

        $year  = preg_replace('/\d{2}$/', '', $date);
        $month = (int)preg_replace('/^\d{4}/', '', $date);
        
        // 指定年月が今月　且つ　今月が15日を過ぎていなければ
        if ($month === (int)date('n') && (int)date('d') < 15) {
            $from = "$year-" . sprintf('%02d', $month - 1) . "-" . $this->devit_limit_day;
            $to   = "$year-". sprintf('%02d', $month) . "-" . $this->devit_limit_day;
        } else {
            $from = "$year-" . sprintf('%02d', $month) . "-" . $this->devit_limit_day;
            $to   = "$year-" . sprintf('%02d', $month + 1) . "-" . $this->devit_limit_day;
        }
        
        $cashDao = new cash();
        $re = 0;
        foreach ($cashDao->devit_pay_amont($from, $to) as $num => $data) {          
            $re = $data->sum_price;
            if (empty($re)) $re = 0;
            break;
        }
        return $re;
    }

    /*
     * 指定年月と指定年月の前月の明細情報を取得する
     */ 
    public function fetch_detail($date) : array
    {
        if (empty($date) || mb_strlen($date) !== 6) $data = date('Ym');

        $year  = preg_replace('/\d{2}$/', '', $date);
        $month = (int)preg_replace('/^\d{4}/', '', $date);

        $from = "$year-" . sprintf('%02d', $month - 1);
        $to   = "$year-" . sprintf('%02d', $month);

        $cashDao = new cash();
        return $cashDao->fetch_all_detail_date($from, $to);
    }

}
