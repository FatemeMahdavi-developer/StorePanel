<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Admin\ProductBrandController;
use Modules\Product\Http\Controllers\Admin\ProductCatController;

Route::middleware(['auth'])->group(function(){

    Route::resource('productbrand',ProductBrandController::class)->except(['store','update','destroy']);
    Route::resource('productcat',ProductCatController::class)->except(['store','update','destroy']);

});
