<?php

namespace Modules\Product\Livewire\Admin\Price;


use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\productPriceRequest;
use Modules\Product\Models\Admin\Product;

class Create extends Component
{
    use AuthorizesRequests,UpdatingValidation,LivewireAlert;


    public $price,$discount,$price_code,$number,$numberlimit,$moduleTitle;
    public $product;
    public function mount(Product $product){
        $this->moduleTitle=config('product.priceModuleTitle');
        $this->product=$product;
        // $this->authorize('create',$this->model);
    }

    public function validationClass()
    {
        return productPriceRequest::class;
    }
    
    public function save(){
        $inputs=$this->validate();
        $this->product->price()->create($inputs);
        $this->resetExcept(['product','model','moduleTitle']);
        return $this->alert('success',__('admin.added_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }
    public function render()
    {
        return view('product::livewire.admin.price.create');
    }
}
