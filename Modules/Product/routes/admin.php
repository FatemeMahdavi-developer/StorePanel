<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Admin\ProductBrandController;

Route::prefix('productbrand')->as('productbrand.')->group(function(){
    Route::get('create',[ProductBrandController::class,'create'])->name('create');
});
