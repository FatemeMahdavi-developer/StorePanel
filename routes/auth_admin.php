<?php
use App\Http\Controllers\Admin\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')->as("auth.")->group(function () {
    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store'])->name('login');;
});

Route::middleware('auth:admin')->as("auth.")->group(function () {
    Route::get('logout', [LoginController::class,'destroy'])->name('logout');
});


