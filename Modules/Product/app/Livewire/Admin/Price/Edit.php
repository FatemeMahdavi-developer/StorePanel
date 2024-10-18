<?php

namespace Modules\Product\Livewire\Admin\Price;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\productPriceRequest;
use Modules\Product\Models\Admin\productPrice;

class Edit extends Component
{
    use UpdatingValidation,LivewireAlert;

    public $price,$discount,$price_code,$number,$numberlimit,$moduleTitle;

    public $productPrice;

    public function mount(productPrice $productPrice){
        $this->moduleTitle=config('product.priceModuleTitle');

        $this->productPrice=$productPrice;
        $this->price=$this->productPrice->price;
        $this->discount=$this->productPrice->discount;
        $this->price_code=$this->productPrice->price_code;
        $this->number=$this->productPrice->number;
        $this->numberlimit=$this->productPrice->numberlimit;
    }

    public function validationClass()
    {
        return productPriceRequest::class;
    }

    public function update(){
        $this->productPrice->update($this->validate());
        return $this->alert('success',__('admin.edited_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('product::livewire.admin.price.edit');
    }
}
