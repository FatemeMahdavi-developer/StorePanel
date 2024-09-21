<?php

namespace Modules\ProductBrand\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductBrandFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\ProductBrand\Models\ProductBrand::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $title=sprintf("برند%s",rand(1,100));
        return [
            "title"=>$title,
            "seo_url"=>$title,
            "seo_title"=>$title
        ];
    }
}

