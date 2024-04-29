<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\DB;

class Rules extends Model
{
    protected $table = 'rules';

    public function addrules($data)
    {
        try {
            $result = null;
            DB::transaction(function () use ($data, &$result) {
                $insertArray = [
                    'created_at'    =>  date('Y-m-d H:i:s', time()),
                    'updated_at'    =>  null
                ];
                return ( $result = ['status' => 1, 'thisRulesID' => $this->insertGetId(array_merge($insertArray, $data))] );
            });
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 0, 'msg' => $th];
        }
    }
}
