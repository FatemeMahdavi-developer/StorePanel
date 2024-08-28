<?php

namespace Modules\ProductCat\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\ProductCat\Models\ProductCat;

class AdminProductCatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product_cats=ProductCat::all();
        return view('productcat::admin.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('productcat::admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCat $productcat)
    {
        return view('productcat::admin.edit',compact("productcat"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
