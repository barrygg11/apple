<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;

use App\Http\Controllers\ModelController as Model;

class GcpController extends Controller
{
    private $SitePage = 50;
    private $VersionPage = 20;

    public function _index(Content $content, String $site = 'prd') { return $content->view(($this->adminPrefixView.'_site'), ['site' => $site]); }
    public function _index2(Content $content, String $site = 'prd') { return $content->view(($this->adminPrefixView.'_load_balancer'), ['site' => $site]); }
    public function _index3(Content $content, String $site = 'prd') { return $content->view(($this->adminPrefixView.'_version'), ['site' => $site]); }
    public function _index4(Content $content, String $site = 'prd') { return $content->view(($this->adminPrefixView.'_sshkey'), ['site' => $site]); }

    public function index(Request $request, String $site = 'prd')
    {
        // 待優化~
        $thisSite = (function () use ($site) {
            switch ($site) {
                case 'dev':     return 'bigdata-dev-287803';    break;
                case 'stg':     return 'bigdata-stg-365503';    break;
                case 'uat':     return 'bigdata-uat-288809';    break;
                case 'prd':     return 'bigdata-prd';           break;
                case 'devops':  return 'bigdata-devops-308512'; break;
                default:        return 'bigdata-prd';           break;
            }
        })();

        $Search = [];

        // if ( isset($request->zone) ) { $Search['zone'] = $request->zone; }
        if ( isset($request->status) ) { $Search['status'] = $request->status; }

        if ( isset($request->name) && isset($request->network_ip) && isset($request->nat_ip) ){
            $data = Model::table('MachineList')->where($Search)->where('project', $thisSite)->where('name', 'like', "%{$request->name}%")->where('network_ip', 'like', '%'.$request->network_ip.'%')->where('nat_ip', 'like', '%'.$request->nat_ip.'%')->orderByDesc('id')->Paginate($this->SitePage);
            $Search['name'] = $request->name;
            $Search['network_ip'] = $request->network_ip;
            $Search['nat_ip'] = $request->nat_ip;
        } else if ( isset($request->name) && isset($request->network_ip) ) {
            $data = Model::table('MachineList')->where($Search)->where('project', $thisSite)->where('name', 'like', "%{$request->name}%")->where('network_ip', 'like', '%'.$request->network_ip.'%')->orderByDesc('id')->Paginate($this->SitePage);
            $Search['name'] = $request->name;
            $Search['network_ip'] = $request->network_ip;
        } else {
            if ( isset($request->name) ) {
                $data = Model::table('MachineList')->where($Search)->where('project', $thisSite)->where('name', 'like', "%{$request->name}%")->orderByDesc('id')->Paginate($this->SitePage);
                $Search['name'] = $request->name;
            } else if ( isset($request->network_ip) ) {
                $data = Model::table('MachineList')->where($Search)->where('project', $thisSite)->where('network_ip', 'like', '%'.$request->network_ip.'%')->orderByDesc('id')->Paginate($this->SitePage);
                $Search['network_ip'] = $request->network_ip;
            } else if ( isset($request->nat_ip) ) {
                $data = Model::table('MachineList')->where($Search)->where('project', $thisSite)->where('nat_ip', 'like', '%'.$request->nat_ip.'%')->orderByDesc('id')->Paginate($this->SitePage);
                $Search['nat_ip'] = $request->nat_ip;
            } else {
                $data = Model::table('MachineList')->where($Search)->where('project', $thisSite)->orderByDesc('id')->Paginate($this->SitePage);
            }
        }

        return view('Admin.site', ['data' => $data, 'Search' => json_encode($Search)]);
    }

    public function index2(Request $request, String $site = 'prd')
    {
        // $data = [];

        // return view('Admin.load_balancer', ['data' => $data]);

                // 待優化~
                $thisSite = (function () use ($site) {
                    switch ($site) {
                        case 'dev':     return 'bigdata-dev-287803';    break;
                        case 'stg':     return 'bigdata-stg-365503';    break;
                        case 'uat':     return 'bigdata-uat-288809';    break;
                        case 'prd':     return 'bigdata-prd';           break;
                        case 'devops':  return 'bigdata-devops-308512'; break;
                        default:        return 'bigdata-prd';           break;
                    }
                })();

                $Search = [];

                if ( isset($request->name) ) { $Search['name'] = $request->name; }

                $rules_data = Model::table('Security')->where($Search)->where('project', $thisSite)->get()->toArray();

                $data = Model::table('Rules')->where($Search)->where('project', $thisSite)->orderByDesc('id')->Paginate($this->SitePage);
        
                return view('Admin.loadsite', ['data' => $data, 'Search' => json_encode($Search), 'rules_list' => $rules_data]);
    }

    public function index3(Request $request,  String $site = 'prd')
    {
        // $data = [];

        // return view('Admin.load_balancer', ['data' => $data]);
                // 待優化~
                $thisSite = (function () use ($site) {
                    switch ($site) {
                        case 'dev':     return 'dev';                  break;
                        case 'stg':     return 'stg';                  break;
                        case 'uat':     return 'uat';                  break;
                        case 'prd':     return 'prd';                  break;
                        case 'devops':  return 'devops';               break;
                        default:        return 'prd';                  break;
                    }
                })();

                $Search = [];

                if ( isset($request->project) ) { $Search['project'] = $request->project; }

                $gitlab_list = Model::table('GitLab')->select('project')->where($Search)->where('site', $thisSite)->distinct()->get()->toArray();

                $data = Model::table('GitLab')->where($Search)->where('site', $thisSite)->orderByDesc('id')->Paginate($this->SitePage);

        return view('Admin.version', ['data' => $data,'list'=> $gitlab_list]);
    }

    public function index4(Request $request,  String $site = 'prd')
    {
        $data = [];

        $thisSite = (function () use ($site) {
            switch ($site) {
                case 'dev':     return 'bigdata-dev-287803';    break;
                case 'stg':     return 'bigdata-stg-365503';    break;
                case 'uat':     return 'bigdata-uat-288809';    break;
                case 'prd':     return 'bigdata-prd';           break;
                case 'devops':  return 'bigdata-devops-308512'; break;
                default:        return 'bigdata-prd';           break;
            }
        })();

        $data = Model::table('SshKey')->where('project', $thisSite)->orderByDesc('id')->Paginate($this->SitePage);

        return view('Admin.sshkey', ['data' => $data]);
    }
}
