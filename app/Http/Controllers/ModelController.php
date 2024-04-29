<?php

namespace App\Http\Controllers;

class ModelController
{
    // Model層路徑
    private static $ModelPath = '\App\Models\\';

    public static function table($modelName)
    {
        $Path = self::$ModelPath.$modelName;
        return (new $Path);
    }
}
