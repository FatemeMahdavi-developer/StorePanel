<?php

namespace Modules\Product\Models\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Base\Traits\DateConvert;
use Modules\Base\Enums\StateEnum;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

// use Modules\Product\Database\Factories\Admin/productcatFactory;

class productcat extends Model implements HasMedia
{
    use HasFactory,InteractsWithMedia,DateConvert,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'seo_url',
        'seo_title',
        'title',
        'note',
        'state',
        'id',
        'parent_id'
    ];

    protected function casts(): array
    {
        return [
            'state' => StateEnum::class,
        ];
    }
    public function scopeFilter(Builder $builder,array $params){
        if(!empty($params['parent_id'])){
            $builder->where('parent_id',$params['parent_id']);
        }else{
            $builder->where('parent_id',null);
        }
        return $builder;
    }
    public function registerMediaConversions(?Media $media = null): void
    {
        $this
            ->addMediaConversion('preview')
            ->fit(Fit::Contain, 300, 300)
            ->nonQueued();
    }

    public function product_cat_brand():BelongsToMany
    {
        return $this->belongsToMany(ProductBrand::class);
    }

    public function subCats(){
        return $this->hasMany(productcat::class,'parent_id');
    }
}
