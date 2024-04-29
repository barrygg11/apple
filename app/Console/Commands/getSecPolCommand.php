<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ModelController as Model;

class getSecPolCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:security {project}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'security-policies';

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
        $project = $this->argument('project');

        $json = shell_exec("gcloud compute security-policies list --project=$project");
        $lines_1 = explode("\n", $json);

        foreach ($lines_1 as $key => $respon) {
            if ($key == 0) {
                continue;
            }
            if ($respon == "") {
                continue;
            }

            $security = Model::table('security')->addSecurity([
                'project'      =>  $project,
                'name'         =>  $respon,
                'rules'        => "999, 1000, 1001, 1002, 1003, 2147483647"
            ]);
            if ( !$security['status'] ) {
                return response()->json(['status' => 0, 'msg' => "新增政策列表失敗({$security['msg']})"]);
            }
        }
        
    }
}
