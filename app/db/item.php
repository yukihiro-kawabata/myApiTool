<?php

namespace App\db;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class item extends Model
{
    protected $table = 'item';

    public function getDataAllApiName() {
        return DB::select("select api_name from item");
    }

    public function getDataByApiName(string $api_name) {
        return DB::select("select * from item where api_name  = '$api_name'");
    }
}
