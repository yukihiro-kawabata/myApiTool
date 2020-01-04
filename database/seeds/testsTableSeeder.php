<?php

use Illuminate\Database\Seeder;

class testsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = \Carbon\Carbon::now();
        for ($i = 1; $i <= 50; $i++) {

            $name = '';
            for ($nameNum = 1; $nameNum <=6; $nameNum++) {
                $name .= chr(mt_rand(65,90));
            }
            $title = '';
            for ($titleNum = 1; $titleNum <=30; $titleNum++) {
                $title .= chr(mt_rand(65,90));
            }
            
            $vector = [
                "id"         => null,
                "name"       => $name,
                "title"      => $title,
                "msg"        => $name . PHP_EOL . $title,
                "plan"       => "plan" . rand(),
                "created_at" => $now,
                "updated_at" => $now,
            ];
          DB::table("test")->insert($vector);
        }
    }
}
