<?php

namespace Modules\Product\Livewire\Admin\ProductCat;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\ProductCatValidation;
use Illuminate\Validation\Rule;
use Modules\Product\Models\Admin\ProductBrand;

class Edit extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation;
    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model,$product_brands,$product_brands_selected;

    public $productcat;

    public function mount($productcat)
    {
        $this->product_brands=ProductBrand::get(['id','title']);
        $this->product_brands_selected=$productcat->product_cat_brand()->get()->pluck('id')->toArray();
        $this->moduleTitle=config('product.categoryModuleTitle');
        $this->model='product-cat';
        $this->productcat=$productcat;
        $this->seo_url=$this->productcat->seo_url;
        $this->seo_title=$this->productcat->seo_title;
        $this->title=$this->productcat->title;

        $this->image=$productcat->getMedia('image')->first()?->getUrl() ?? '';
        $this->note=$this->productcat->note;
    }
    public function validationClass()
    {
        return ProductCatValidation::class;
    }

    // public function getPath(Media $media): string
    // {
    //     return $this->getBasePath($media).'/'.$this->model;
    // }

    public function rules()
    {
        $rules=$this->validationClass()::rules();
        $rules['seo_url']=['required','string',Rule::unique('product_brands','seo_url')->ignore($this->productcat->id)];
        if(!empty($this->image) &&  in_array(pathinfo($this->image,PATHINFO_EXTENSION),['jpeg','png','PNG','jpg','gif','svg','webp'])){
            $rules['image']=[];
        }
        return $rules;
    }

    public function deleteImage()
    {
        $this->productcat->media()->where('collection_name','image')->delete();
        $this->pathImage = null;
        $this->image = null;
    }

    public function update(){
        $inputs=$this->validate();
        if(!empty($inputs['image'])){
            $inputs['image']=$this->pathImage;
        }
        $this->productcat->update($inputs);
        if(!empty($inputs['image'])){
            $this->productcat->media()->where('collection_name','image')->delete();
            $this->productcat->addMedia($this->image)->toMediaCollection('image');
        }
        $this->reset('pathImage');
        return back()->with('message', __('common.msg.successfully', [
            'module' =>$this->moduleTitle
        ]));
    }
    public function render()
    {
        return view('product::livewire.admin.product-cat.edit');
    }
}