<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { return redirect(url((env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/login'))); });

/* ---------------- Admin ---------------- */
Route::group(['prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'), 'middleware' => ['auth:admin', 'AuthAdminRole']], function () {
    // 公告
    Route::get('/_', 'Admin\HomeController@index')->name('adminHome');
        // 新增公告
        Route::post('/_/addAnnouncement', 'Admin\HomeController@ajaxAddAnnouncement')->name('ajaxAddAnnouncement');
        // 刪除公告
        Route::post('/_/delAnnouncement', 'Admin\HomeController@ajaxDelAnnouncement')->name('ajaxDelAnnouncement');
    // 常用連結
    Route::get('/_link/{site?}', 'Admin\LinkController@index')->name('adminLink');
    // 查詢機器
    Route::get('/_gcp/{site?}', 'Admin\GcpController@index')->name('adminGcpSite');
    // GCP負載平衡
    Route::get('/_gcp_lb/{site?}', 'Admin\GcpController@index2')->name('adminGcpLoadBalancer');
    // 專案版號
    Route::get('/_version/{site?}', 'Admin\GcpController@index3')->name('adminGcpVersion');
    // SSH-KEY
    Route::get('/_sshkey/{site?}', 'Admin\GcpController@index4')->name('adminGcpSshKey');
    // 帳戶設定
    Route::get('/_setting', 'Admin\AdminController@index2')->name('adminSetting');
        // 設定個人資料
        Route::post('/_setting/setSetting', 'Admin\AdminController@ajaxSetSetting')->name('ajaxSetSetting');
    // 權限管控
    Route::get('/_adminList', 'Admin\AdminController@index')->name('adminAdminList');
        // 新增管理員
        Route::post('/_adminList/addAdmin', 'Admin\AdminController@ajaxAddAdmin')->name('ajaxAddAdmin');
        // 設定管理員資料
        Route::post('/_adminList/setAdmin', 'Admin\AdminController@ajaxSetAdmin')->name('ajaxSetAdmin');
        // 刪除管理員
        Route::post('/_adminList/delAdmin', 'Admin\AdminController@ajaxDelAdmin')->name('ajaxDelAdmin');
});

Route::group(['prefix' => env('ADMIN_ROUTE_PREFIX', 'admin'), 'middleware' => ['auth:admin', 'AuthAdminRole']], function () {
    Route::get('/', 'Admin\HomeController@_index');
    Route::get('/link/{site?}', 'Admin\LinkController@_index');
    Route::get('/gcp/{site?}', 'Admin\GcpController@_index');
    Route::get('/gcp_lb/{site?}', 'Admin\GcpController@_index2');
    Route::get('/version/{site?}', 'Admin\GcpController@_index3');
    Route::get('/sshkey/{site?}', 'Admin\GcpController@_index4');
    Route::get('/setting', 'Admin\AdminController@_index2');
    Route::get('/adminList', 'Admin\AdminController@_index');
});
/* ---------------- Admin ---------------- */
