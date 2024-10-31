<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\DateConvert;
use Modules\Product\Enums\TypeEnum;

// use Modules\Product\Database\Factories\Admin/QuestionFactory;

class Question extends Model
{
    use HasFactory,DateConvert;

    protected $table="question";

    protected $fillable = [
        'title',
        'type',
        'question_cat_id',
        'state'
    ];

    // protected static function newFactory(): Admin/QuestionFactory
    // {
    //     // return Admin/QuestionFactory::new();
    // }

    protected function casts(): array
    {
        return [
            'type' => TypeEnum::class,
            'state' => StateEnum::class
        ];
    }

    public function enumsLang(): array
    {
        return __('product::enums');
    }

    public function question_cat(){
        return $this->belongsTo(questionCat::class);
    }

    public function items(){
        return $this->hasMany(questionItems::class);
    }
}
