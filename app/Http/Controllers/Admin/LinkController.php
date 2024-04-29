<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
// use Illuminate\Http\Request;

class LinkController extends Controller
{
    public function _index(Content $content, String $site = 'prd') { return $content->view(($this->adminPrefixView.'_link'), ['site' => $site]); }

    public function index(String $site = 'prd')
    {
        return view('Admin.link', ['site' => $site]);
    }
}
