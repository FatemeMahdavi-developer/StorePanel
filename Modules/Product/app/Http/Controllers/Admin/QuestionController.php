<?php

namespace Modules\Product\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Product\Models\Admin\Question;

class QuestionController extends Controller
{

    public function index()
    {
        return view('product::admin.question.index');
    }

    public function create()
    {
        return view('product::admin.question.create');
    }

    public function edit(Question $question)
    {
        return view('product::admin.question.edit',compact('question'));
    }

}
