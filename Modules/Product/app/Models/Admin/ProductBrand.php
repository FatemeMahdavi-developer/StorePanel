<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

// use Modules\Product\Database\Factories\Admin/ProductBrandFactory;

class ProductBrand extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'seo_url',
        'seo_title',
        'title',
        'note'
    ];

    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    // protected static function newFactory(): Admin/ProductBrandFactory
    // {
    //     // return Admin/ProductBrandFactory::new();
    // }
}
