<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\Auth;

class AdminConfig extends Model
{
    protected $table = 'admin_config';

    public function addAdminConfig($data)
    {
        try {
            $insertArray = [
                // type, admin_id, create_time
                'status'        =>  1,
                'remark'        =>  ('由 [ '.Auth::user()->id.' ][ '.Auth::user()->name.' ] 創建'),
                'update_time'   =>  null,
                'delete_time'   =>  null
            ];
            return ['status' => 1, 'thisAdminConfigID' => $this->insertGetId(array_merge($insertArray, $data))];
        } catch (\Throwable $th) {
            return ['status' => 0, 'msg' => 'T_ERROR'];
        }
    }
}
