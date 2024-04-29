<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ModelController as Model;

class AdminController extends Controller
{
    private $Page = 10;
    private $ConfigFun = 'AdminConfig';

    public function _index(Content $content) { return $content->view("{$this->adminPrefixView}_adminList"); }
    public function _index2(Content $content) {
        if ( Auth::user()->id == 1 ) { return redirect(route('admin.setting')); }
        return $content->view("{$this->adminPrefixView}_setting");
    }

    public function index()
    {
        $data = Model::table('Admin')
                    ->whereHas(
                        $this->ConfigFun, function ($query) {
                            return $query->whereNull('delete_time');
                        }
                    )
                    ->Paginate($this->Page);

        return view('Admin.adminList', ['data' => $data]);
    }

    public function ajaxAddAdmin(Request $request)
    {
        if ( $request->password != $request->password2 ) { return response()->json(['status' => 0, 'msg' => '密碼輸入不一致']); }

        $thisAdmin = Model::table('Admin')->where(['username' => $request->account])
                        ->whereHas(
                            $this->ConfigFun, function ($query) {
                                return $query->whereNull('delete_time');
                            }
                        )
                        ->first();

        if ( is_null($thisAdmin) ) {
            $AdminModelR = Model::table('Admin')->addAdmin([
                                'type'      =>  $request->type,
                                'username'  =>  $request->account,
                                'password'  =>  password_hash($request->password, PASSWORD_DEFAULT),
                                'name'      =>  $request->name
                            ]);
            if ( !$AdminModelR['status'] ) {
                return $this->Rjson($req, "新增失敗({$AdminModelR['msg']})");
            }

            return response()->json(['status' => 1, 'msg' => '新增管理員成功']);
        }

        return response()->json(['status' => 0, 'msg' => '改管理員已存在']);
    }

    public function ajaxSetAdmin(Request $request)
    {
        if ( !in_array($request->type, ['password'], true) ) {
            return response()->json(['status' => 0, 'msg' => '偵測非法類型']);
        }

        if ( $request->type == 'password' ) {
            $request->value = password_hash($request->value, PASSWORD_DEFAULT);
        }

        $thisAdmin = Model::table('Admin')->where(['id' => $request->thisID])
                        ->whereHas(
                            $this->ConfigFun, function ($query) {
                                return $query->whereNull('delete_time');
                            }
                        )
                        ->first();
        if ( empty($thisAdmin) ) { return response()->json(['status' => 0, 'msg' => '查無管理員']); }

        $upt = Model::table('Admin')->where(['id' => $thisAdmin->id])->update([$request->type => $request->value, 'updated_at' => date('Y-m-d H:i:s', time())]);
        if ( $upt !== 1 ) { return response()->json(['status' => 0, 'msg' => '更新資料失敗']); }

        return response()->json(['status' => 1, 'msg' => '更新資料成功']);
    }

    public function ajaxDelAdmin(Request $request)
    {
        $thisAdmin = Model::table('Admin')->where(['id' => $request->thisID])
                        ->whereHas(
                            $this->ConfigFun, function ($query) {
                                return $query->whereNull('delete_time');
                            }
                        )
                        ->first();
        if ( empty($thisAdmin) ) { return response()->json(['status' => 0, 'msg' => '查無管理員']); }

        $thisAdminConfig = Model::table('AdminConfig')->where(['admin_id' => $thisAdmin->id])->whereNull('delete_time')->first();
        if ( empty($thisAdminConfig) ) { return response()->json(['status' => 0, 'msg' => '查無管理員關聯']); }

        $nowTime = time();

        $uptAdmin = Model::table('Admin')->where(['id' => $thisAdmin->id])->update([
                        'username'          =>  ("{$thisAdmin->username}_".md5($nowTime)),
                        'password'          =>  '',
                        'remember_token'    =>  null,
                        'updated_at'        =>  date('Y-m-d H:i:s', $nowTime)
                    ]);
        if ( $uptAdmin !== 1 ) { return response()->json(['status' => 0, 'msg' => '刪除管理員失敗']); }

        $uptAdminConfig = Model::table('AdminConfig')->where(['admin_id' => $thisAdmin->id])->update([
                            'status'        =>  0,
                            'remark'        =>  ("{$thisAdminConfig->remark}, 由 [ ".Auth::user()->id.' ][ '.Auth::user()->name.' ] 刪除'),
                            'delete_time'   =>  $nowTime
                        ]);
        if ( $uptAdminConfig !== 1 ) { return response()->json(['status' => 0, 'msg' => '刪除管理員失敗']); }

        return response()->json(['status' => 1, 'msg' => '刪除管理員成功']);
    }

    public function index2()
    {
        $data = Model::table('Admin')->where(['id' => Auth::user()->id])
                    ->whereHas(
                        $this->ConfigFun, function ($query) {
                            return $query->whereNull('delete_time');
                        }
                    )
                    ->first();

        return view('Admin.setting', ['data' => $data]);
    }

    public function ajaxSetSetting(Request $request)
    {
        $UpdatePassword = false;

        if ( empty($request->name) ) { return response()->json(['status' => 0, 'msg' => '未輸入用戶名稱']); }
        if ( mb_strlen($request->name) > 191 ) { return response()->json(['status' => 0, 'msg' => '用戶名稱過長']); }
        // if ( !preg_match('/^[a-zA-Z0-9\x{4e00}-\x{9fa5}]+$/u', $request->name) ) { return response()->json(['status' => 0, 'msg' => '用戶名稱格式錯誤']); }

        if ( isset($request->new_password) ) {
            if ( empty($request->new_password) ) { return response()->json(['status' => 0, 'msg' => '未輸入新密碼']); }
            if ( empty($request->password) ) { return response()->json(['status' => 0, 'msg' => '未輸入當前密碼']); }
            if ( empty($request->new_password2) ) { return response()->json(['status' => 0, 'msg' => '未輸入二次密碼']); }
            // if ( !preg_match('/^[a-zA-Z0-9]+$/', $request->new_password) ) { return response()->json(['status' => 0, 'msg' => '新密碼格式錯誤']); }
        }

        if ( isset($request->new_password2) ) {
            if ( empty($request->new_password2) ) { return response()->json(['status' => 0, 'msg' => '未輸入二次密碼']); }
            if ( empty($request->password) ) { return response()->json(['status' => 0, 'msg' => '未輸入當前密碼']); }
            if ( empty($request->new_password) ) { return response()->json(['status' => 0, 'msg' => '未輸入新密碼']); }
            // if ( !preg_match('/^[a-zA-Z0-9]+$/', $request->new_password2) ) { return response()->json(['status' => 0, 'msg' => '二次密碼格式錯誤']); }
        }

        if ( isset($request->new_password) && isset($request->new_password2) ) {
            if ( $request->password == $request->new_password || $request->password == $request->new_password2 ) { return response()->json(['status' => 0, 'msg' => '新密碼不得一樣']); }
            if ( $request->new_password != $request->new_password2 ) { return response()->json(['status' => 0, 'msg' => '密碼不一致']); }
            $UpdatePassword = true;
        }

        $thisUser = Model::table('Admin')->where(['id' => Auth::user()->id])->first();
        if ( empty($thisUser) ) { return response()->json(['status' => 0, 'msg' => '查無用戶']); }

        if ( $UpdatePassword ) {
            if ( !password_verify($request->password, $thisUser->password) ) { return response()->json(['status' => 0, 'msg' => '原密碼輸入錯誤']); }
            Model::table('Admin')->where(['id' => Auth::user()->id])->update([
                'name'      =>  $request->name,
                'password'  =>  password_hash($request->new_password, PASSWORD_DEFAULT)
            ]);
            // Auth::logout();
            return response()->json(['status' => 1, 'msg' => '更新資料成功', 'url' => url((env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/login'))]);
        }

        if ( $thisUser->name == $request->name ) { return response()->json(['status' => 0, 'msg' => '資料未異動']); }

        Model::table('Admin')->where(['id' => Auth::user()->id])->update(['name' => $request->name]);

        return response()->json(['status' => 1, 'msg' => '更新資料成功']);
    }
}
