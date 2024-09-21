<?php

namespace Modules\ProductCat\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductCatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     */
    protected $model = \Modules\ProductCat\Models\ProductCat::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [];
    }
}

