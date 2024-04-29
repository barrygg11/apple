<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\ModelController;

class Admin extends Model
{
    protected $table = 'admin_users';

    public function addAdmin($data)
    {
        try {
            $result = null;
            DB::transaction(function () use ($data, &$result) {
                $nowTime = time();
                $type = $data['type'];
                unset($data['type']);
                $insertArray = [
                    // type, username, password, name
                    'avatar'            =>  null,
                    'remember_token'    =>  null,
                    'created_at'        =>  date('Y-m-d H:i:s', $nowTime),
                    'updated_at'        =>  null
                ];
                $thisAdminID = $this->insertGetId(array_merge($insertArray, $data));
                $AdminConfigModelR = ModelController::table('AdminConfig')->addAdminConfig([
                                        'type'          =>  $type,
                                        'admin_id'      =>  $thisAdminID,
                                        'create_time'   =>  $nowTime
                                     ]);
                if ( !$AdminConfigModelR['status'] ) {
                    DB::rollBack();
                    return ( $result = ['status' => 0, 'msg' => "新增管理員關聯失敗({$AdminConfigModelR['msg']})"] );
                }
                $AdminRoleUsersModelR = ModelController::table('AdminRoleUsers')->addAdminRoleUsers([
                                        'role_id'       =>  $type,
                                        'user_id'       =>  $thisAdminID,
                                        'created_at'    =>  date('Y-m-d H:i:s', $nowTime)
                                     ]);
                if ( !$AdminRoleUsersModelR['status'] ) {
                    DB::rollBack();
                    return ( $result = ['status' => 0, 'msg' => (
                        empty($AdminRoleUsersModelR['msg']) ?
                            '新增管理員權限失敗' :
                            "新增管理員權限失敗({$AdminRoleUsersModelR['msg']})"
                    )] );
                }
                return ( $result = ['status' => 1, 'thisAdminID' => $thisAdminID, 'thisAdminConfigID' => $AdminConfigModelR['thisAdminConfigID']] );
            });
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 0, 'msg' => 'T_ERROR'];
        }
    }

    public function AdminConfig()
    {
        return $this->hasOne('App\Models\AdminConfig');
    }
}
