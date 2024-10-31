<?php

namespace Modules\Product\Http\Requests\Admin;
use Illuminate\Validation\Rule;

class QuestionValidation
{
    /**
     * Get the validation rules that apply to the request.
     */
    public static function rules(): array
    {
        return [
            'title' => ['required','string','min:3','max:100'],
            'type' => ['required'],
            'question_cat_id' => ['required','integer',Rule::exists('question_cats','id')],
            'items' => ['nullable', 'array'],
            'items.*' => ['required', 'string', 'max:255', 'distinct'],
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
