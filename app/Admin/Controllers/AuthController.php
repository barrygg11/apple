<?php

namespace App\Admin\Controllers;

use Illuminate\Http\Request;

use Encore\Admin\Controllers\AuthController as BaseAuthController;

class AuthController extends BaseAuthController
{
    public function getLogin()
    {
        if ($this->guard()->check()) {
            return redirect($this->redirectPath());
        }

        return view('Admin.Login');
    }

    public function getLogout(Request $request)
    {
        $this->guard()->logout();

        return redirect(url((env('ADMIN_ROUTE_PREFIX', 'admin').'/auth/login')));
    }
}
