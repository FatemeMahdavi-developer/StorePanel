<?php

namespace Modules\Product\Livewire\Admin\ProductBrand;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Livewire\Validation\Admin\ProductBrandValidation;

class Edit extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation,LivewireAlert;

    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model;

    public $productbrand;

    public function mount($productbrand)
    {
        $this->moduleTitle=config('product.brandModuleTitle');
        $this->model='product-brand';

        $this->productbrand=$productbrand;
        $this->seo_url=$this->productbrand->seo_url;
        $this->seo_title=$this->productbrand->seo_title;
        $this->title=$this->productbrand->title;
        
        $this->image=$productbrand->getMedia('image')->first()?->getUrl() ?? '';
        $this->note=$this->productbrand->note;
    }
    public function validationClass()
    {
        return ProductBrandValidation::class;
    }

    // public function getPath(Media $media): string
    // {
    //     return $this->getBasePath($media).'/'.$this->model;
    // }

    public function rules()
    {
        $rules=$this->validationClass()::rules();
        $rules['seo_url']=['required','string',Rule::unique('product_brands','seo_url')->ignore($this->productbrand->id)];
        if(!empty($this->image) &&  in_array(pathinfo($this->image,PATHINFO_EXTENSION),['jpeg','png','PNG','jpg','gif','svg','webp'])){
            $rules['image']=[];
        }
        return $rules;
    }

    public function deleteImage()
    {
        $this->productbrand->media()->where('collection_name','image')->delete();
        $this->pathImage = null;
        $this->image = null;
    }

    public function update(){
        $inputs=$this->validate();
        if(!empty($inputs['image'])){
            $inputs['image']=$this->pathImage;
        }
        $this->productbrand->update($inputs);
        if(!empty($inputs['image'])){
            $this->productbrand->media()->where('collection_name','image')->delete();
            $this->productbrand->addMedia($this->image)->toMediaCollection('image');
        }
        $this->reset('pathImage');
        $this->alert('success',__('common.msg.successfully', [
            'module' =>$this->moduleTitle
        ]));
    }


    public function render()
    {
        return view('product::livewire.admin.product-brand.edit');
    }
}
