<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\cash\cash_batch_model;

use App\Model\slack\slack_push_model;

class cash_remind_regist_list_batch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:cash_remind_regist_list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'cash明細に自動でデータを定期的に入れるデータをリマンドするバッチ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $cash_batch_model = new cash_batch_model();
        $cash_batch_model->remind_constant_cash_list();
    }
}
