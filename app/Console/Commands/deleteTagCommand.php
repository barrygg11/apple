<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ModelController as Model;

class deleteTagCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:tag {site}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete tag';

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
        $site = $this->argument('site');

        $hyper = [];

        if ($site == "all") {
            $getSiteDate = Model::table('GitLab')->get()->toArray();
        }
        $getSiteDate = Model::table('GitLab')->where('site', $site)->get()->toArray();

        if ($site == "dev" || $site == "stg") {
            $days = '1209600';
        }

        if ($site == "uat" || $site == "prd") {
            $days = '2592000';
        }

        $date = $days/86400;
        
        foreach ($getSiteDate as $key => $hu) {
            $hyper[] = [$hu['id']=>strtotime($hu['created_at'])];
        }

        foreach ($hyper as $hypers) {
            foreach ($hypers as $keyss => $hyperss) {
                $sev = $hyperss+$days;
                $now = strtotime("now");
                if ($now > $sev) {
                    $delete = Model::table('GitLab')->where('id', $keyss)->delete();
                    echo "ID:{$keyss},超過{$date}天,已刪除{$delete}".PHP_EOL;
                }

                echo "ID:{$keyss},未超過{$date}天,無需處理".PHP_EOL;
            }
        }
    }
}
