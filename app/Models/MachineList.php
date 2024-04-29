<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\DB;

class MachineList extends Model
{
    protected $table = 'machine_list';

    public function addMachineList($data)
    {
        try {
            $result = null;
            DB::transaction(function () use ($data, &$result) {
                $insertArray = [
                    // project, name, zone, network_ip, [nat_ip], machine_type, status
                    'nat_ip'        =>  null,
                    'created_at'    =>  date('Y-m-d H:i:s', time()),
                    'updated_at'    =>  null
                ];
                return ( $result = ['status' => 1, 'thisMachineListID' => $this->insertGetId(array_merge($insertArray, $data))] );
            });
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 0, 'msg' => $th];
        }
    }
}
