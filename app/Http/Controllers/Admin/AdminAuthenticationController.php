<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HandleLogin;
use Illuminate\Http\Request;

class AdminAuthenticationController extends Controller
{
    public function login()
    {
        return view("admin.auth.login");
    }

    public function handleLogin(HandleLogin $request)
    {
        $request->authenticate();

        return redirect()->route("admin.dashboard");
    }
}
