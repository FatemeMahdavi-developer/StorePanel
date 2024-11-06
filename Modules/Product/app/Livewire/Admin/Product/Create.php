<?php

namespace Modules\Product\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Models\Admin\product;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Modules\Base\Enums\StateEnum;
use Modules\Product\Http\Requests\Admin\productValidation;
use Modules\Product\Models\Admin\productcat;
use Modules\Product\Models\Admin\questionCat;

class Create extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation,LivewireAlert;

    public $productBrands=[];
    public $seo_url,$seo_title,$cat_id,$title,$image,$pathImage,$note,$moduleTitle,$model,$brand_id;
    public $questionCat,$questuin_answer;
    public function mount(){
        $this->moduleTitle=config('product.productModuleTitle');
        $this->model=product::class;
    }
    public function validationClass()
    {
        return productValidation::class;
    }

    public function updatedTitle($value){
        $this->seo_url=str::slug($value,'-',null);
        $this->seo_title=$value;
    }

    public function updatingCatid($value)
    {
        $productcat=productcat::find($value);
        if(!empty($value)){
            $this->questionCat=$productcat->questionCat;
            $this->productBrands=$productcat->product_cat_brand->pluck('title','id')->toArray();
        }
    }

    public function productCats(){
        return productcat::where('parent_id',null)->get();
    }

    public function save(){
        $inputs=$this->validate();

        $inputs['state']=StateEnum::DISABLE;
        $product=product::create($inputs);

        if(!empty($this->image)){
            $product->addMedia($this->image)->toMediaCollection('image');
        }
        $this->resetExcept(['moduleTitle','model','product_brands']);

        return $this->alert('success',__('admin.added_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }
    public function render()
    {
        return view('product::livewire.admin.product.create',[
            'productCats'=>$this->productCats()
        ]);
    }
}
