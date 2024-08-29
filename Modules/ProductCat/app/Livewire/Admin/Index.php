<?php

namespace Modules\ProductCat\Livewire\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\ProductCat\Models\ProductCat;

class Index extends Component
{
    use LivewireAlert,WithPagination;
    public $item_ids=[];
    public $check_all=false;

    public function getListeners()
    {
        return [
            'confirmed'
        ];
    }
    public function check_all_items()

    {
        // dd($this->item_ids);
        if($this->check_all){
            foreach($this->product_cats()->pluck('id')->toArray() as $id){
                $this->item_ids[$id]=true;
            }
        }else{
            $this->item_ids=[];
        }

    }

    // public function gotoPage($page, $pageName = 'page')
    // {
    //     $this->setPage($page, $pageName);
    //     $this->check_all=false;
    //     $this->item_ids=[];
    // }



    public function delete_all(){
        $this->confirm('می خواهید حذف کنید؟', [
            'confirmButtonText' => 'بله',
            'cancelButtonText' => 'خیر',
            'icon' => '',
            'onConfirmed' => 'confirmed',
        ]);
    }   


    public function confirmed() 
    {

       foreach ($this->item_ids as $key => $value) {
        // dd($this->item_ids);   
            if($value===true){
                ProductCat::find($key)->delete();
            }
       }
       $this->item_ids=[];
       $this->check_all=false;
    }  
    public function change_state(ProductCat $product_cat){
        $state=($product_cat->state==="active") ? 'disable' : 'active';
        $product_cat->update(['state'=>$state]);
    }
    

    public function updatingPaginators(){
        $this->reset("check_all","item_ids");
    }
    public function product_cats(){
        return ProductCat::paginate(3);
    }
    public function render()
    {
        return view('productcat::livewire.admin.index',['product_cats'=>$this->product_cats()]);
    }
}
