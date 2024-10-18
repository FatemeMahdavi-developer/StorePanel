<?php

namespace Modules\Product\Livewire\Admin\ProductBrand;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Livewire\Validation\Admin\ProductBrandValidation;
use Modules\Product\Models\Admin\ProductBrand;

class Create extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation,LivewireAlert;

    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model;

    public function mount(){
        $this->moduleTitle=config('product.brandModuleTitle');
        $this->model=ProductBrand::class;
        // $this->authorize('create',$this->model);
    }

    public function validationClass()
    {
        return ProductBrandValidation::class;
    }

    public function updatedTitle($value){
        $this->seo_url=str::slug($value,'-',null);
        $this->seo_title=$value;
    }

    public function save(){
        $inputs=$this->validate();
        $inputs['state']=StateEnum::DISABLE;
        $productBrand=ProductBrand::create($inputs);
        if(!empty($this->image)){
            $productBrand->addMedia($this->image)->toMediaCollection('image');
        }
        $this->resetExcept(['moduleTitle']);
        $this->alert('success',__('common.msg.added', [
            'module' =>$this->moduleTitle
        ]));
    }

    public function render()
    {
        return view('product::livewire.admin.product-brand.create');
    }
}
