<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Admin\questionCat;

class QuestionCatController extends Controller
{
    public function index()
    {
        return view('product::admin.question_cat.index');
    }

    public function create()
    {
        return view('product::admin.question_cat.create');
    }

    public function edit(questionCat $questioncat)
    {
        return view('product::admin.question_cat.edit',compact('questioncat'));
    }
}
