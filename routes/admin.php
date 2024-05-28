<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthenticationController;

Route::group(["prefix" => "/admin", "as" => "admin."], function () {
    Route::get("/login", [AdminAuthenticationController::class, "login"])->name("login");
    Route::post("/login", [AdminAuthenticationController::class, "handleLogin"])->name("handle-login");
});

Route::group(["prefix" => "/admin", "as" => "admin.", "middleware" => ["admin"]], function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");
});


