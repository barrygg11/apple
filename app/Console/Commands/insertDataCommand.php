<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ModelController as Model;

class insertDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:instances {project} {zone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '第一次寫入機器列表';

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
        $zone = $this->argument('zone');
        
        $format_name = "table(name)";
        $format_network_ip = "table(networkInterfaces[0].networkIP)";
        $format_nat_ip = "table(networkInterfaces[0].accessConfigs[0].natIP)";
        $format_machine_type = "table(machineType)";
        $format_status = "table(status)";

        $command_1 = "gcloud compute instances list --project=$project --zones=$zone --format=\"$format_name\"";

        $output_1 = shell_exec($command_1);
        
        $lines_1 = explode("\n", $output_1);

        $command_2 = "gcloud compute instances list --project=$project --zones=$zone --format=\"$format_network_ip\"";

        $output_2 = shell_exec($command_2);
        
        $lines_2 = explode("\n", $output_2);

        $command_3 = "gcloud compute instances list --project=$project --zones=$zone --format=\"$format_nat_ip\"";

        $output_3 = shell_exec($command_3);
        
        $lines_3 = explode("\n", $output_3);

        $command_4 = "gcloud compute instances list --project=$project --zones=$zone --format=\"$format_machine_type\"";

        $output_4 = shell_exec($command_4);
        
        $lines_4 = explode("\n", $output_4);

        $command_5 = "gcloud compute instances list --project=$project --zones=$zone --format=\"$format_status\"";

        $output_5 = shell_exec($command_5);
        
        $lines_5 = explode("\n", $output_5);

        $array = array($lines_1,$lines_2,$lines_3,$lines_4,$lines_5);

        $newArray = array();
        for ($i = 0; $i < count($array[0]); $i++) {
            $newArray[$i] = array();
            for ($j = 0; $j < count($array); $j++) {
                $newArray[$i][$array[$j][0]] = $array[$j][$i];
            }
        }

        foreach ($newArray as $key => $respon) {
            if ($key == 0) {
                continue;
            }
            if ($respon['NAME'] == "") {
                continue;
            }

            // MachineList::addMachineList($project, $respon['NAME'], $zone, $respon['NETWORK_IP'], $respon['NAT_IP'], $respon['MACHINE_TYPE'], $respon['STATUS']);

            $data = Model::table('MachineList')->where('project', $project)->where('zone', $zone)->where('name',$respon['NAME'])->get('name')->toArray();


            if (empty($data)) {
                $MachineListModelR = Model::table('MachineList')->addMachineList([
                    'project'      =>  $project,
                    'name'         =>  $respon['NAME'],
                    'zone'         =>  $zone,
                    'network_ip'   =>  $respon['NETWORK_IP'],
                    'nat_ip'       =>  $respon['NAT_IP'],
                    'machine_type' =>  $respon['MACHINE_TYPE'],
                    'status'       =>  $respon['STATUS']
                ]);
                if ( !$MachineListModelR['status'] ) {
                    return response()->json(['status' => 0, 'msg' => "新增機器失敗({$MachineListModelR['msg']})"]);
                }
            }
        }
    }
}
