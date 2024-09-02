<?php

namespace Modules\ProductCat\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\ProductCat\Models\ProductCat;

class Index extends Component
{
    use LivewireAlert,WithPagination;
    // start delete
    public $items = [];
    public $selectAll = false;


    public function getListeners()
    {
        return [
            'confirmed'
        ];
    }
    public function check_all()
    {
        if($this->check_all){
            foreach($this->product_cats()->pluck('id')->toArray() as $id){
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
            ProductCat::find($value)->delete();
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
            $product_cat=ProductCat::findOrFail($id);
            $state=($product_cat->state==='disable') ? 'active' : 'disable';
            $product_cat->update(['state'=>$state]);
        }
    }

    public function action_all(){

    }
    //end state_all

    public function change_state(ProductCat $product_cat){
        $state=($product_cat->state==="active") ? 'disable' : 'active';
        $product_cat->update(['state'=>$state]);
    }

    public function updatingPaginators(){
        $this->reset("selectAll","items");
    }
    public function product_cats(){
        return ProductCat::paginate(3);
    }
    public function render()
    {
        return view('productcat::livewire.admin.index',['product_cats'=>$this->product_cats()]);
    }
}
