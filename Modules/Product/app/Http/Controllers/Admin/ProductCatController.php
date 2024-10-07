<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Admin\productcat;

class ProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('product::admin.product_cat.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::admin.product_cat.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(productcat $productcat)
    {
        return view('product::admin.product_cat.edit',compact('productcat'));
    }

}
