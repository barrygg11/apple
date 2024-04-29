<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Support\Facades\DB;

class Announcement extends Model
{
    protected $table = 'announcement';

    public function addAnnouncement($data)
    {
        try {
            $result = null;
            DB::transaction(function () use ($data, &$result) {
                $insertArray = [
                    // type, unit, personnel, content
                    'create_time'   =>  time(),
                    'delete_time'   =>  null
                ];
                return ( $result = ['status' => 1, 'thisAnnouncementID' => $this->insertGetId(array_merge($insertArray, $data))] );
            });
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
            return ['status' => 0, 'msg' => 'T_ERROR'];
        }
    }
}
