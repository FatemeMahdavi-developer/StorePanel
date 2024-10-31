<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Modules\Product\Database\Factories\Admin/questionItemsFactory;

class questionItems extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'question_id',
        'value'
    ];
    

    // protected static function newFactory(): Admin/questionItemsFactory
    // {
    //     // return Admin/questionItemsFactory::new();
    // }
}
