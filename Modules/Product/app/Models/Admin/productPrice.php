<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\DateConvert;

// use Modules\Product\Database\Factories\Admin/productPriceFactory;

class productPrice extends Model
{
    use HasFactory,DateConvert,SoftDeletes;
    protected static function boot(){
        parent::boot();
        static::created(function($model){
            $model->price_active=1;
            $model->save();
        });
    }
    protected $table="product_prices";

    protected $fillable = [
        'price',
        'discount',
        'price_code',
        'number',
        'numberlimit',
        'price_active',
        'product_id'
    ];
    protected function casts(): array
    {
        return [
            'price_active' => StateEnum::class,
        ];
    }
    /**
     * The attributes that are mass assignable.
     */

    // protected static function newFactory(): Admin/productPriceFactory
    // {
    //     // return Admin/productPriceFactory::new();
    // }
}
