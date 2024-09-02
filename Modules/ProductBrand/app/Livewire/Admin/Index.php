<?php

namespace Modules\ProductBrand\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\ProductBrand\Models\ProductBrand;

class Index extends Component
{
    use LivewireAlert,WithPagination;
    // start delete
    public $items = [];
    public $selectAll = false;

    public $productbrand;


    public function getListeners()
    {
        return [
            'confirmed',
            'confirm_delete',
        ];
    }
    public function check_all()
    {
        $this->items=[];
        if($this->selectAll){
            foreach($this->product_brands()->pluck('id')->toArray() as $id){
                $this->items[]=$id;
            }
        }
    }
    public function delete_all(){
        if(empty($this->items)){
            $this->alert('error', 'لطفا انتخاب کنید', [
                'position' => 'top-end'
            ]);
        }else{
            $this->confirm('می خواهید حذف کنید؟', [
                'confirmButtonText' => 'بله',
                'cancelButtonText' => 'خیر',
                'icon' => '',
                'onConfirmed' => 'confirmed',
            ]);
        }

    }
    public function confirmed()
    {
       foreach (array_unique($this->items) as $value) {
            ProductBrand::find($value)->delete();
       }
       $this->items=[];
       $this->selectAll=false;
    }
    // end delete


    //start state_all

    public function state_all(){
        if(empty($this->items)){
            $this->alert('error', 'لطفا انتخاب کنید', [
                'position' => 'top-end'
            ]);
        }
        foreach($this->items as $id){
            $product_brand=ProductBrand::findOrFail($id);
            $state=($product_brand->state==='disable') ? 'active' : 'disable';
            $product_brand->update(['state'=>$state]);
        }
    }
    //end state_all

    public function confirm_delete(){
        $this->productbrand->delete();
    }


    public function delete(ProductBrand $product_brand){
        $this->productbrand=$product_brand;
        $this->confirm('مطمئن هستید می خواهید حذف کنید؟', [
            'confirmButtonText' => 'بله',
            'cancelButtonText' => 'خیر',
            'icon' => '',
            'onConfirmed' => 'confirm_delete',
        ]);
    }

    public function change_state(ProductBrand $product_brand){
        $state=($product_brand->state==="active") ? 'disable' : 'active';
        $product_brand->update(['state'=>$state]);
    }

    public function updatingPaginators(){
        $this->reset("selectAll","items");
    }
    public function product_brands(){
        return ProductBrand::paginate(3);
    }
    public function render()
    {
        return view('productbrand::livewire.admin.index',['product_brands'=>$this->product_brands()]);
    }
}
