<?php

namespace Modules\Product\Livewire\Admin\Product;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Models\Admin\product;
use Illuminate\Support\Str;
use Modules\Product\Http\Requests\Admin\productValidation;

class Create extends Component
{
    use WithFileUploads,AuthorizesRequests,UpdatingValidation;

    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model;
    public function mount(){
        $this->moduleTitle=config('product.productModuleTitle');
        $this->model=product::class;
        // $this->authorize('create',$this->model);
    }
    public function validationClass()
    {
        return productValidation::class;
    }

    public function updatedTitle($value){
        $this->seo_url=str::slug($value,'-',null);
        $this->seo_title=$value;
    }
    public function render()
    {
        return view('product::livewire.admin.product.create');
    }
}
