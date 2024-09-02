<?php

use Illuminate\Support\Facades\Route;
use Modules\ProductCat\Http\Controllers\AdminProductCatController;

Route::resource('productcat', AdminProductCatController::class)->names('productcat')->except('show');
