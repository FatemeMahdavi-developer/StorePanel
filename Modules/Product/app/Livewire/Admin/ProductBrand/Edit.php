<?php

namespace Modules\Product\Livewire\Admin\ProductBrand;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\Product\Models\Admin\ProductBrand;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Edit extends Component
{
    use WithFileUploads,AuthorizesRequests;

    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model;

    public $productbrand;

    public function mount($productbrand)
    {
        $this->moduleTitle='برند محصول';
        $this->model='product-brand';

        $this->productbrand=$productbrand;
        $this->seo_url=$this->productbrand->seo_url;
        $this->seo_title=$this->productbrand->seo_title;
        $this->title=$this->productbrand->title;

        $this->image=$productbrand->getMedia('image')->first()?->getUrl() ?? '';
        $this->note=$this->productbrand->note;
    }

    public function getPath(Media $media): string
    {
        return $this->getBasePath($media).'/'.$this->model;
    }


    public function rules(){
        return[
            'seo_url' => ['required','string',Rule::unique('product_brands','seo_url')->ignore($this->productbrand->id)],
            'seo_title' => ['required','min:3','max:100'],
            'title' => ['required','min:3'],
            'image' => ['nullable','image','mimes:png,jpeg,gif,svg','max:1024'],
            'note'=>['nullable','string']
        ];
    }


    public function deleteImage()
    {
        $this->productbrand->media()->where('collection_name','image')->delete();
        $this->pathImage = null;
        $this->image = null;
    }

    public function updatingImage($value){
        $this->pathImage='';
        $this->validate([
            'image' => $this->rules()['image']
        ]);
        $this->image=$value;
        $this->pathImage=$value;
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
        return back()->with('message', __('common.msg.successfully', [
            'module' =>$this->moduleTitle
        ]));
    }


    public function render()
    {
        return view('product::livewire.admin.product-brand.edit');
    }
}
