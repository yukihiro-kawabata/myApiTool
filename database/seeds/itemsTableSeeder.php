<?php

use Illuminate\Database\Seeder;

class itemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();            
        $vector = [
            "id"             => null,
            "api_name"       => "test_name",
            "explain"        => "demo",
            "method"         => "GET",
            "db_name"        => "mysql",
            "db_table"       => 'test',
            "db_table_col"   => '*',
            "required1"      => 'name',
            "required2"      => 'title',
            "required_text1" => 'ex). name=joy',
            "required_text2" => 'ex). title=test title',
            "param1"         => 'id',
            "param_text1"    => 'ex). id=1',
            "created_at"     => $now,
            "updated_at"     => $now,
        ];
        DB::table("item")->insert($vector);
        
    }
}
