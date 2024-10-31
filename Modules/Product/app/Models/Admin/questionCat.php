<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Traits\DateConvert;

// use Modules\Product\Database\Factories\Admin/questionCatFactory;

class questionCat extends Model
{
    use HasFactory,SoftDeletes,DateConvert;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title'
    ];

    public function questionCats_productCats(){
        return $this->belongsToMany(productcat::class);
    }
}
