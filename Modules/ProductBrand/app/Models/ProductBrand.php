<?php

namespace Modules\ProductBrand\Models;

use App\trait\admin\date_convert;
use App\trait\admin\SlugMethod;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Validation\Rule;
use Modules\ProductBrand\Database\Factories\ProductBrandFactory;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProductBrand extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,date_convert,SlugMethod;
    protected $fillable = [
        'admin_id',
        'seo_url',
        'seo_title',
        'title',
        'pic',
        'note',
        'state',
        'state_main',
        'order'
    ];
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    protected static function newFactory(): ProductBrandFactory
    {
        return ProductBrandFactory::new();
    }


    public static function rules($params): array
    {
        $rules=[
            'seo_url'=>['required','string',Rule::unique('product_brands','seo_url')->ignore($params->productـbrand->id)],
            'seo_title'=>['nullable','string','min:3'],
            'title'=>['required','string','min:3','max:255'],
            'pic'=>['nullable','image','max:1024','mimes:jpg,jpeg,png,svg,webp,gif'],
            'parent_id'=>['nullable'],
            'note'=>['nullable','string']
        ];
       if(is_string($params->pic) &&  in_array(pathinfo($params->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
       }
        return $rules;
    }
}
