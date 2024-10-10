<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\DateConvert;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
// use Modules\Product\Database\Factories\ProductFactory;

class product extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,InteractsWithMedia,DateConvert,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'seo_url',
        'seo_title',
        'title',
        'note',
        'state',
        'cat_id',
        'brand_id'
    ];

    protected function casts(): array
    {
        return [
            'state' => StateEnum::class,
        ];
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }
    // protected static function newFactory(): ProductFactory
    // {
    //     // return ProductFactory::new();
    // }
}
