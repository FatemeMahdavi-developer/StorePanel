<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Admin\ProductBrandController;
use Modules\Product\Http\Controllers\Admin\ProductCatController;
use Modules\Product\Http\Controllers\Admin\productController;
use Modules\Product\Http\Controllers\Admin\productPriceController;
use Modules\Product\Http\Controllers\Admin\QuestionCatController;

Route::middleware(['auth'])->group(function(){
    Route::resource('productbrand',ProductBrandController::class)->except(['store','update','destroy']);
    Route::resource('productcat',ProductCatController::class)->except(['store','update','destroy']);
    Route::resource('product',productController::class)->except(['store','update','destroy']);
    Route::resource('product.price',productPriceController::class)->except(['store','update','destroy','show'])->shallow();
    Route::resource('questioncat',QuestionCatController::class)->except(['store','update','destroy']);
});
