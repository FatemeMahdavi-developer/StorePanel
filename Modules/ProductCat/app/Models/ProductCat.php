<?php

namespace Modules\ProductCat\Models;

use App\trait\admin\date_convert;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductBrand\Models\ProductBrand;
use Modules\ProductCat\Database\Factories\ProductCatFactory;

class ProductCat extends Model
{
    use HasFactory,SoftDeletes,date_convert;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'admin_id',
        'seo_url',
        'seo_title',
        'title',
        'pic',
        'note',
        'parent_id',
        'state',
        'state_main',
        'order'
    ];
    protected static function newFactory(): ProductCatFactory
    {
        //return ProductCatFactory::new();
    }
    public function sub_cats(){
        return $this->hasMany(ProductCat::class,'parent_id');
    }

    public function product_brand(){
        return $this->belongsToMany(ProductBrand::class);
    }
}
