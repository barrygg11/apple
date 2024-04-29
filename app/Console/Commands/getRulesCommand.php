<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Exception;
use App\Http\Controllers\TelegramSendApi;
use App\Http\Controllers\ModelController as Model;

class getRulesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:rules {project}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '新增LB資料列表';

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

        $data = Model::table('Security')->where('project', $project)->get()->toArray();

        foreach ($data as $key => $respon) {
            $name = $respon['name'];

            $rules_arr = array_map('intval', explode(', ', $respon['rules']));
            
            foreach ($rules_arr as $rules_once) {
                try {
                    $json = shell_exec("gcloud compute security-policies rules describe $rules_once --security-policy=$name --project=$project");

                    if (empty($json)) {
                        continue;
                    }

                    $yaml = Yaml::parse($json);
    
                    $srcIpRanges = $yaml['match']['config']['srcIpRanges'];
                    unset($yaml['match']);
                    $yaml['srcIpRanges'] = $srcIpRanges;
        
                    $yaml['ip'] = implode(", ",$yaml['srcIpRanges']);
        
                    $yaml = array($yaml);
        
                    foreach ($yaml as $re_yaml) {
                        $Rulesa = Model::table('Rules')->addrules([
                            'project'      =>  $project,
                            'name'         =>  $name,
                            'order'        =>  $re_yaml['priority'],
                            'ip'           =>  $re_yaml['ip'],
                            'status'       =>  $re_yaml['action'],
                            'description'  =>  $re_yaml['description']
                        ]);
                        if ( !$Rulesa['status'] ) {
                            return response()->json(['status' => 0, 'msg' => "新增LB資料({$Rulesa['msg']})"]);
                        }
                    }
                } catch (Exception $e) {
                    continue;
                }
            }
        }
    }
}
