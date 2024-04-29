<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ModelController as Model;

class HomeController extends Controller
{
    private $Page = 20;

    public function _index(Content $content) { return $content->view(($this->adminPrefixView.__FUNCTION__)); }

    public function index()
    {
        $data = Model::table('Announcement')->whereNull('delete_time')->orderByDesc('id')->Paginate($this->Page);

        return view('Admin.index', ['data' => $data, 'UserConfig' => Model::table('AdminConfig')->where(['admin_id' => Auth::user()->id])->whereNull('delete_time')->first()]);
    }

    public function ajaxAddAnnouncement(Request $request)
    {
        $AnnouncementModelR = Model::table('Announcement')->addAnnouncement([
                                'type'      =>  1,
                                'unit'      =>  $request->unit,
                                'personnel' =>  $request->personnel,
                                'content'   =>  $request->message
                            ]);
        if ( !$AnnouncementModelR['status'] ) {
            return response()->json(['status' => 0, 'msg' => "新增公告失敗({$AnnouncementModelR['msg']})"]);
        }

        return response()->json(['status' => 1, 'msg' => '新增公告成功']);
    }

    public function ajaxDelAnnouncement(Request $request)
    {
        $thisAnnouncement = Model::table('Announcement')->where(['id' => $request->thisID])->whereNull('delete_time')->first();
        if ( empty($thisAnnouncement) ) { return response()->json(['status' => 0, 'msg' => '查無該資料']); }

        $upt = Model::table('Announcement')->where(['id' => $thisAnnouncement->id])->update(['delete_time' => time()]);
        if ( $upt !== 1 ) { return response()->json(['status' => 0, 'msg' => '刪除資料失敗']); }

        return response()->json(['status' => 1, 'msg' => '刪除資料成功']);
    }
}
