<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\TelegramSendApi;
use App\Http\Controllers\ModelController as Model;

class getAnnouncementCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:announcement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '發送公告';

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
     * @return int
     */
    public function handle()
    {

        $data = Model::table('Announcement')->get()->toArray();


        foreach ($data as $resp) {

            $data_date = date('Y-m-d', strtotime($resp['create_time']));
            $sort_data = strtotime($data_date);

            $today_data = strtotime(date("Y-m-d"));

            if ($today_data-86400 == $sort_data) {
                // TelegramSendApi::SendApi("Hamu Hamu Hamu");
                $message = "【系統公告通知】\n  (1) 單位: {$resp['unit']} \n  (2) 人員: {$resp['personnel']}\n  (3) 內文: {$resp['content']}\n  (4) 時間: {$data_date}";
                TelegramSendApi::SendApi($message);
            }
        }
        
    }
}
