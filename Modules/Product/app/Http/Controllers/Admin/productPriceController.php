<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Admin\product;
use Modules\Product\Models\Admin\productPrice;

class productPriceController extends Controller
{
    public function index(product $product)
    {
        return view('product::admin.price.index',compact('product'));
    }

    public function create(product $product)
    {
        return view('product::admin.price.create',compact('product'));
    }

    public function edit(productPrice $price)
    {
        return view('product::admin.price.edit',['productPrice'=>$price]);
    }
}
