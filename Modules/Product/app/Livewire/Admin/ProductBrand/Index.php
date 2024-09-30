<?php

namespace Modules\Product\Livewire\Admin\ProductBrand;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Product\Models\Admin\ProductBrand;

class Index extends Component
{
    use LivewireAlert,WithPagination;

    public $items = [];
    public $selectAll = false;
    public int $paginate=3;

    // public $productBrands=[];
    public $moduleTitle;

    public function mount(){
        $this->moduleTitle='برند محصول';

    }

    public function getListeners()
    {
        return [
            'confirmed',
            // 'confirm_delete',
        ];
    }

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->productBrands()->pluck('id')->toArray() : [];
    }

    public function deleteAll(){
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
        ProductBrand::whereIn('id',$this->items)->delete();
        $this->items=[];
        $this->selectAll=false;
    }

    public function stateAll(){
        if(empty($this->items)){
            $this->alert('error', 'لطفا انتخاب کنید', [
                'position' => 'top-end'
            ]);
        }
        foreach($this->items as $id){
            $productBrand=ProductBrand::findOrFail($id);
            $state=($productBrand->state==='disable') ? 'active' : 'disable';
            $productBrand->update(['state'=>$state]);
        }
        $this->reset();
    }

    // public function confirmDelete(){
    //     $this->productBrands->delete();
    // }


    // public function delete(ProductBrand $productbrand){
    //     $this->productBrands=$productbrand;
    //     $this->confirm('مطمئن هستید می خواهید حذف کنید؟', [
    //         'confirmButtonText' => 'بله',
    //         'cancelButtonText' => 'خیر',
    //         'icon' => '',
    //         'onConfirmed' => 'confirmDelete',
    //     ]);
    // }

    public function changeState(ProductBrand $productbrand){
        $state=($productbrand->state==="active") ? 'disable' : 'active';
        $productbrand->update(['state'=>$state]);
    }

    public function updatingPaginators(){
        $this->reset("selectAll","items");
    }

    public function productBrands(){
        return ProductBrand::paginate($this->paginate);
    }

    public function render()
    {
        return view('product::livewire.admin.product-brand.index',[
            'productBrands'=>$this->productBrands()
        ]);
    }
}
