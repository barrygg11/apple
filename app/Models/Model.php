<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as BaseModel;

class Model extends BaseModel
{
    public $timestamps = false;

    protected $casts = [
        'create_time'       =>  'datetime:Y-m-d H:i:s'
    ];
}
