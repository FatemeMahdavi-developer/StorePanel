<?php

namespace Modules\Product\Http\Requests\Admin;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
class productValidation extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public static function rules()
    {
        return [
            'seo_url' => ['required', 'string', Rule::unique('product', 'seo_url')],
            'seo_title' => ['required', 'min:3', 'max:100'],
            'title' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif,svg', 'max:1024'],
            'note' => ['nullable', 'string'],
        ];
    }


    // public function prepareForValidation($attributes):array
    // {
    //     $attributes['seo_url'] = Str::slug($attributes['seo_url'], '-', null);
    //     return $attributes;
    // }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
