<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductBrand\Http\Controllers\AdminProductBrandController;

Route::resource('brand', AdminProductBrandController::class)->names('brand')->except('show');
