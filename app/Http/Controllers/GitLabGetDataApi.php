<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\ModelController as Model;

class GitLabGetDataApi extends Controller
{
    public static function getDataApi(Request $request) {

        $site = $request->site;
        $project = $request->project;
        $tag = $request->tag;
        $commit = $request->commit;
        $deployer = $request->deployer;

        $GitLab = Model::table('GitLab')->addGitLab([
            'site'         =>  $site,
            'project'      =>  $project,
            'tag'          =>  $tag,
            'commit'       =>  $commit,
            'deployer'     =>  $deployer
        ]);

        $response = [];

        if (!empty($GitLab)) {
            $response = ['status' => 200, 'msg' => "Post Data success"];
        } else {
            $response = ['status' => 404, 'msg' => "Post Data fail"];
        }

        return $response;
    }
}
