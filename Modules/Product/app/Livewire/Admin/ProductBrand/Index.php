<?php

namespace Modules\Product\Livewire\Admin\ProductBrand;

use Modules\Base\Classes\Admin\ActionAll;
use Modules\Base\Enums\StateEnum;
use Modules\Product\Models\Admin\ProductBrand;

class Index extends ActionAll
{
    public $items=[];
    public $selectAll=false;
    public int $paginate=3;
    public $moduleTitle;

    public function mount(){
        $this->moduleTitle='برند محصول';
    }

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->productBrands()->pluck('id')->toArray() : [];
    }

    public function actionAll($action,$field=''){
        if(!empty($field)){
            $this->action($action,ProductBrand::class,$this->$field);
            return $this->$field='';
        }else{
            return $this->action($action,ProductBrand::class);
        }
    }

    public function delete(ProductBrand $productbrand){
        $productbrand->delete();
    }

    public function changeState(ProductBrand $productbrand){
        $state=($productbrand->state->value==StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
        $productbrand->update(['state'=>$state]);
    }

    public function productBrands(){
        return ProductBrand::orderBy('id','DESC')->paginate($this->paginate);
    }

    public function render()
    {
        return view('product::livewire.admin.product-brand.index',[
            'productBrands'=>$this->productBrands()
        ]);
    }
}
