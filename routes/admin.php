<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminAuthenticationController;

Route::group(["prefix" => "/admin", "as" => "admin."], function () {
    // Login
    Route::get("/login", [AdminAuthenticationController::class, "login"])->name("login");
    Route::post("/login", [AdminAuthenticationController::class, "handleLogin"])->name("handle-login");

    // Forgot Password
    Route::get("/forgot-password", [AdminAuthenticationController::class, "forgotPassword"])->name("forgot-password");
    Route::post("/forgot-password", [AdminAuthenticationController::class, "sendResetLink"])->name("forgot-password.send");

    // Reset Password
    Route::get("/reset-password/{token}", [AdminAuthenticationController::class, "resetPassword"])->name("reset-password");
    Route::post("/reset-password", [AdminAuthenticationController::class, "storePassword"])->name("reset-password.store");

    // Logout
    Route::post("/logout", [AdminAuthenticationController::class, "logout"])->name("logout");
});

Route::group(["prefix" => "/admin", "as" => "admin.", "middleware" => ["admin"]], function () {
    Route::get("/dashboard", [DashboardController::class, "index"])->name("dashboard");

    // Profile
    Route::put("/profile-password-update/{id}", [ProfileController::class,"updatePassword"])->name("profile-password.update");
    Route::resource("/profile", ProfileController::class);

    // Language Route
    Route::resource("/language", LanguageController::class);
});


