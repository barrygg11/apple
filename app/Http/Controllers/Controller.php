<?php

namespace App\Http\Controllers;

class Controller
{
    protected $adminPrefixView = 'Admin.leading.';

    public function __construct()
    {
        app('view')->prependNamespace('admin', resource_path('views/LaravelAdminViews'));
    }
}
