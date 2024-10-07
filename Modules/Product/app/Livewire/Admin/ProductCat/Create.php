<?php

namespace Modules\Product\Livewire\Admin\ProductCat;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\ProductCatValidation;
use Modules\Product\Models\Admin\ProductBrand;
use Modules\Product\Models\Admin\productcat;

class Create extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation;
    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model;
    public $product_brands_selected=[];
    public $product_brands=[];
    public function mount(){
        $this->product_brands=ProductBrand::get(['id','title']);
        $this->moduleTitle=config('product.categoryModuleTitle');
        $this->model=productcat::class;
    }
    public function validationClass()
    {
        return ProductCatValidation::class;
    }

    public function updatedTitle($value){
        $this->seo_url=Str::slug($value,'-',null);
        $this->seo_title=$value;
    }

    public function save(){
        $inputs=$this->validate();
        $inputs['state']=StateEnum::DISABLE;
        $productCat=productcat::create($inputs);
        if(!empty($this->image)){
            $productCat->addMedia($this->image)->toMediaCollection('image');
        }
        $productCat->product_cat_brand()->sync($this->product_brands_selected);
        $this->resetExcept(['moduleTitle','model','product_brands']);
        return back()->with('message', __('admin.added_successfully',[
            'module' => $this->moduleTitle
        ]));
    }
    public function render()
    {
        return view('product::livewire.admin.product-cat.create');
    }
}
