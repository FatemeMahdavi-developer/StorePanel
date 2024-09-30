<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\Http\Controllers\Admin\ProductBrandController;

Route::middleware(['auth'])->group(function(){

    Route::resource('productbrand',ProductBrandController::class)->except(['store','update','destroy']);

});
