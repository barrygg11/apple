<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Yaml\Yaml;
use Exception;
use App\Http\Controllers\ModelController as Model;

class getShKeyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:sshkey {project}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'ssh_key data';

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

        $json = shell_exec("gcloud compute project-info describe --project=$project");

        $yaml = Yaml::parse($json);

        // $array_y = $yaml['commonInstanceMetadata']['items'][2]['value']; //local

        switch ($project) {
            case "bigdata-dev-287803":
                $array_y = $yaml['commonInstanceMetadata']['items'][3]['value']; //dev
            break;
            case "bigdata-stg-365503":
                $array_y = $yaml['commonInstanceMetadata']['items'][0]['value']; //stg
            break;
            case "bigdata-uat-288809":
                $array_y = $yaml['commonInstanceMetadata']['items'][3]['value']; //uat
            break;
            case "bigdata-prd":
                $array_y = $yaml['commonInstanceMetadata']['items'][3]['value']; //prd
            break;
            case "bigdata-devops-308512":
                $array_y = $yaml['commonInstanceMetadata']['items'][0]['value']; //devops
            break;
        }

        
        $stringArr = explode("\n", $array_y);

        foreach ($stringArr as $stringArrs) {
            $parts = explode(":", $stringArrs);
            $ssh_rsa = $parts[0];
            $checkdata = Model::table('SshKey')->where('project', $project)->where('name',$ssh_rsa)->orderByDesc('id')->get()->toArray();

            if (empty($checkdata)) {
                Model::table('SshKey')->addSshKey([
                    'project'      =>  $project,
                    'name'         =>  $ssh_rsa,
                    'ssh_key'      =>  $stringArrs
                ]);
            }
        }
    }
}
