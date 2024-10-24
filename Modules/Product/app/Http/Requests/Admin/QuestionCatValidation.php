<?php

namespace Modules\Product\Http\Requests\Admin;

use Illuminate\Validation\Rule;

class QuestionCatValidation
{
    /**
     * Get the validation rules that apply to the request.
     */
    public static function rules()
    {
        return [
            'title' => ['required','string','min:3','max:100'],
            'product_cats' => ['required'],
            'product_cats.*' => ['required','integer',Rule::exists('productcats','id')],
        ];
    }

    public static function prepareForValidation($attributes):array
    {
        return $attributes;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
