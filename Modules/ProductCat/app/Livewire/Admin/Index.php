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
    
    public function change_state(ProductCat $product_cat){
        $state=($product_cat->state==="active") ? 'disable' : 'active';
        $product_cat->update(['state'=>$state]);
        // if($product_cat["state"]=="disable"){
        //     $product_cat->update(["state"=>"active"]);
        // }else{
        //     $product_cat->update(["state"=>"disable"]);
        // }
    } 
    public function render()
    {
        return view('productcat::livewire.admin.index',['product_cats'=>$this->product_cats]);
    }
}
