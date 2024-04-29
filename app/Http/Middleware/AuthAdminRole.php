<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as _Request;

use App\Http\Controllers\ModelController as Model;

class AuthAdminRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ( Auth::check() ) {
            $thisAdminConfig = Model::table('AdminConfig')->where(['admin_id' => Auth::user()->id])->whereNull('delete_time')->first();
            if ( empty($thisAdminConfig) ) {
                Auth::logout();
                return redirect(url((env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/login')));
            }
            if ( $thisAdminConfig->status != 1 ) {
                Auth::logout();
                return redirect(url((env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/login')));
            }
            if ( $thisAdminConfig->type == 3 ) {
                if ( in_array(url(_Request::path()), [
                    route('ajaxAddAnnouncement'),   route('ajaxDelAnnouncement'),

                    route('adminAdminList'),        route('ajaxAddAdmin'),          route('ajaxSetAdmin'),      route('ajaxDelAdmin')
                ]) ) {
                    return response()->json(['status' => 0, 'msg' => '一般人員無權限']);
                }
            }
            return $next($request);
        }

        return redirect(url((env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/login')));
    }
}
