<?php

namespace Modules\Product\Livewire\Admin\Product;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\productValidation;
use Modules\Product\Models\Admin\productcat;

class Edit extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation,LivewireAlert;

    public $productBrands=[];
    public $product;
    public $seo_url,$seo_title,$cat_id,$title,$image,$pathImage,$note,$moduleTitle,$model,$brand_id;

    public function mount($product)
    {
        $this->moduleTitle=config('product.productModuleTitle');
        $this->model='product';
        $this->product=$product;
        $this->seo_url=$this->product->seo_url;
        $this->seo_title=$this->product->seo_title;
        $this->title=$this->product->title;
        $this->cat_id=$this->product->cat_id;
        $productcat=productcat::find($this->cat_id);
        $this->productBrands=$productcat->product_cat_brand->pluck('title','id')->toArray();
        $this->brand_id=$this->product->brand_id;
        $this->image=$product->getMedia('image')->first()?->getUrl() ?? '';
        $this->note=$this->product->note;
    }

    public function updatingCatid($value)
    {
        $productcat=productcat::find($value);
        $this->productBrands=$productcat->product_cat_brand->pluck('title','id')->toArray();
    }

    public function validationClass()
    {
        return productValidation::class;
    }

    public function rules()
    {
        $rules=$this->validationClass()::rules();
        $rules['seo_url']=['required','string',Rule::unique('product_brands','seo_url')->ignore($this->product->id)];
        if(!empty($this->image) &&  in_array(pathinfo($this->image,PATHINFO_EXTENSION),['jpeg','png','PNG','jpg','gif','svg','webp'])){
            $rules['image']=[];
        }
        return $rules;
    }

    public function productCats(){
        return productcat::where('parent_id',null)->get();
    }

    public function deleteImage()
    {
        $this->product->media()->where('collection_name','image')->delete();
        $this->pathImage = null;
        $this->image = null;
    }

    public function update(){
        $inputs=$this->validate();

        if(!empty($inputs['image'])){
            $inputs['image']=$this->pathImage;
        }
        $this->product->update($inputs);
        if(!empty($inputs['image'])){
            $this->product->media()->where('collection_name','image')->delete();
            $this->product->addMedia($this->image)->toMediaCollection('image');
        }
        $this->reset('pathImage');
        return  $this->alert('success',__('admin.added_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('product::livewire.admin.product.edit',[
            'productCats'=>$this->productCats()
        ]);
    }
}
