<?php

namespace Modules\Product\Http\Requests\Admin;


class productPriceRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public static function rules(): array
    {
        return [
            "price"=>['required','string','min:1','max:255'],
            "price_code"=>['nullable','string','min:1','max:255'],
            "number"=>['required','string','min:1','max:255'],
            "numberlimit"=>['required','string','min:1','max:255'],
            "discount"=>['nullable','numeric','min:1','max:99','integer']

        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public static function prepareForValidation($attributes):array
    {
        return $attributes;
    }


}
