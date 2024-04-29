<?php

namespace App\Models;

use App\Models\Model;

class AdminRoleUsers extends Model
{
    protected $table = 'admin_role_users';

    public function addAdminRoleUsers($data)
    {
        try {
            $insertArray = [
                // role_id, user_id
            ];
            return ['status' => $this->insert(array_merge($insertArray, $data))];
        } catch (\Throwable $th) {
            return ['status' => 0, 'msg' => 'T_ERROR'];
        }
    }
}
