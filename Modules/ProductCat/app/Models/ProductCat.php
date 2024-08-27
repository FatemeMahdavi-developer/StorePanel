<?php

namespace Modules\ProductCat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\ProductCat\Database\Factories\ProductCatFactory;

class ProductCat extends Model
{
    use HasFactory,SoftDeletes;

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
}
