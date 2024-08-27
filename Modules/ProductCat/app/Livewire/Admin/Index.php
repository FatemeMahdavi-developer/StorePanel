<?php

namespace Modules\ProductCat\Livewire\Admin;

use Livewire\Component;
use Modules\ProductCat\Models\ProductCat;

class Index extends Component
{
    public $product_cats;

    public function mount($product_cats){
        $this->product_cats=$product_cats;
    }
    
    public function render()
    {
        return view('productcat::livewire.admin.index',['product_cats'=>$this->product_cats]);
    }
}
