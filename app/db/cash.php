<?php

namespace App\db;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class cash extends Model
{
    protected $table = 'cash';

    // 明細情報
    public function fetch_all_detail_date(string $from, string $to)
    {
        $sql  = "";
        $sql .= " SELECT * ";
        $sql .= " FROM `cash` ";
        $sql .= " WHERE date LIKE '$from%' ";
        $sql .= "     OR date LIKE '$to%' ";
        $sql .= " ORDER BY date DESC, created_at DESC ";
        return DB::select($sql);
    }

    // list doc
    public function fetch_kamoku_sum_price($date)
    {
        if (empty($date)) $date = date('Y-m');

        $sql = "";
        $sql .= " SELECT kamoku_mst.kamoku_sum, kamoku_mst.amount_flg, sum(cash.price) AS amount ";
        $sql .= " FROM `cash`";
        $sql .= " INNER JOIN kamoku_mst ON cash.kamoku_id = kamoku_mst.kamoku_id ";
        $sql .= " WHERE cash.date LIKE '$date%' ";
        $sql .= " GROUP BY kamoku_mst.kamoku_sum, kamoku_mst.amount_flg ";
        $sql .= " ORDER BY kamoku_mst.amount_flg DESC, amount DESC";

        return DB::select($sql);
    }

    public function sum_balance()
    {
        $sql = "";
        $sql .= " SELECT ";
        $sql .= " kamoku_mst.amount_flg, ";
        $sql .= " SUM( ";
        $sql .= "     CASE kamoku_mst.amount_flg ";
        $sql .= "         WHEN 1 THEN cash.price ";
        $sql .= "         WHEN 2 THEN cash.price * -1 ";
        $sql .= "     END ";
        $sql .= " ) AS balance ";
        $sql .= " FROM `cash` ";
        $sql .= " INNER JOIN kamoku_mst ON cash.kamoku_id = kamoku_mst.kamoku_id ";
        $sql .= " WHERE cash.date > 2020-02 "; // system start was 2020-02
        $sql .= " GROUP BY kamoku_mst.amount_flg ";

        return DB::select($sql);
    }

    // デビットカードの使用金額
    public function devit_pay_amont(string $from, string $to)
    {
        $sql  = "";
        $sql .= " SELECT SUM(price) AS sum_price ";
        $sql .= " FROM `cash` ";
        $sql .= " WHERE name = 'share' ";
        $sql .= "     AND date BETWEEN '$from' AND '$to' ";
        return DB::select($sql);
    }

}
