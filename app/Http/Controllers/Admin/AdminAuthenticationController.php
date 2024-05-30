<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\HandleLogin;
use App\Http\Controllers\Controller;
use App\Mail\AdminSendResetLinkMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\SendResetLinkRequest;
use App\Http\Requests\AdminResetPasswordRequest;

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

        Mail::to($request->email)->send(new AdminSendResetLinkMail($token, $request->email));

        return redirect()->back()->with('success',  __("Link has been sent to your email."));
    }

    public function resetPassword($token) 
    {
        return view("admin.auth.reset-password", compact("token"));
    }

    public function storePassword(AdminResetPasswordRequest $request)
    {
        $admin = Admin::where(["email" => $request->email, "password_reset_token" => $request->token])->first();

        if(!$admin) {
            return back()->with("error",__("Token is invalid"));
        }

        $admin->password = Hash::make($request->password);
        $admin->password_reset_token = null;
        $admin->save();

        return redirect()->route("admin.login")->with("success",__("Password reset successful!"));
    }
}
