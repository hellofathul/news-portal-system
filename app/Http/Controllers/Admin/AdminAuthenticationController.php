<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SendResetLinkRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\HandleLogin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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

    public function logout(Request $request): RedirectResponse {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }

    public function forgotPassword()
    {   
        return view('admin.auth.forgot-password');
    }

    public function sendResetLink(SendResetLinkRequest $request)
    {
        $token = \Str::random(64);

        $admin = Admin::where('email', $request->email)->first();
        $admin->password_reset_token = $token;
        $admin->save();

        
    }
}
