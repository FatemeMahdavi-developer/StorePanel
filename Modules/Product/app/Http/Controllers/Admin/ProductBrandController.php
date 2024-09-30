<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Admin\ProductBrand;

class ProductBrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product::admin.product_brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::admin.product_brand.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductBrand $productbrand)
    {
        return view('product::admin.product_brand.edit',compact('productbrand'));
    }

}
