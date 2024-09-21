<?php

use Illuminate\Support\Facades\Route;
use Modules\Auth\Http\Controllers\Admin\AuthController;

Route::middleware("guest")->group(function (){
    Route::get("login",[AuthController::class,"login"])->name("login");
    // Route::post("logout",[AuthController::class,"logout"])->name("logout");

});