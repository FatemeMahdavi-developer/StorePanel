<?php

namespace Modules\Product\Livewire\Validation\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ProductBrandValidation
{
    public static function rules()
    {
        return [
            'seo_url' => ['required', 'string', Rule::unique('product_brands', 'seo_url')],
            'seo_title' => ['required', 'min:3', 'max:100'],
            'title' => ['required', 'min:3'],
            'image' => ['nullable', 'image', 'mimes:png,jpeg,gif,svg', 'max:1024'],
            'note' => ['nullable', 'string'],
        ];
    }

    public static function prepareForValidation($attributes)
    {
        $attributes['seo_url'] = Str::slug($attributes['seo_url'], '-', null);
        return $attributes;
    }
}
