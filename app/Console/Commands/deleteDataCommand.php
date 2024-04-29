<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\ModelController as Model;

class deleteDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:instances {project} {zone}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '刪除已刪除的機器';

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

        // $new_array = [];
        // $ham_u = [];

        foreach ($newArray as $key => $respon) {
            if ($key == 0) {
                continue;
            }
            if ($respon['NAME'] == "") {
                continue;
            }

            $data = Model::table('MachineList')->where('project', $project)->where('zone', $zone)->where('name',$respon['NAME'])->get('name')->toArray();

            foreach ($data as $dd) {
                $new_array[] = $dd; 
            }

        }

        $notInData = Model::table('MachineList')->where('project', $project)->where('zone', $zone)->whereNotIn('name',$new_array)->get('name')->toArray();

        if (!empty($notInData)) {
            foreach ($notInData as $re_notInData) {
                $ham_u[] = $re_notInData['name'];
            }
    
            if (!empty($ham_u)) {
                $deleteData = Model::table('MachineList')->where('project', $project)->where('zone', $zone)->whereIn('name',$ham_u)->delete();
            }
        }
    }
}
