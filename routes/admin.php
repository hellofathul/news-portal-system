<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthenticationController;

Route::group(["prefix" => "/admin", "as" => "admin."], function () {
    Route::get("/login", [AdminAuthenticationController::class, "login"])->name("login");
    Route::get("/forgot-password", [AdminAuthenticationController::class, "forgotPassword"])->name("forgot-password");
    Route::post("/logout", [AdminAuthenticationController::class, "logout"])->name("logout");
    Route::post("/login", [AdminAuthenticationController::class, "handleLogin"])->name("handle-login");
    Route::post("/forgot-password", [AdminAuthenticationController::class, "sendResetLink"])->name("forgot-password.send");
});

Route::group(["prefix" => "/admin", "as" => "admin.", "middleware" => ["admin"]], function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
});


