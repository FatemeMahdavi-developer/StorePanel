<?php

namespace Modules\Product\Livewire\Admin\ProductCat;
use Modules\Base\Classes\Admin\ActionAll;
use Modules\Base\Enums\StateEnum;
use Modules\Product\Models\Admin\productcat;

class Index extends ActionAll
{
    public $items = [];
    public $selectAll = false;
    public int $paginate=3;
    public $moduleTitle;

    public function mount(){
        $this->moduleTitle='دسته بندی محصول';
    }

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->productCat()->pluck('id')->toArray() : [];
    }

    public function actionAll($action,$field=''){
        if(!empty($field)){
            $this->action($action,productcat::class,$this->$field);
            return $this->$field='';
        }else{
            return $this->action($action,productcat::class);
        }
    }

    public function delete(productcat $productbrand){
        $productbrand->delete();
    }

    public function changeState(productcat $productbrand){
        $state=($productbrand->state->value==StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
        $productbrand->update(['state'=>$state]);
    }
    public function productCat(){
        return productcat::orderBy('id','DESC')->paginate($this->paginate);
    }
    public function render()
    {
        return view('product::livewire.admin.product-cat.index',[
            'productCats'=>$this->productCat()
        ]);
    }
}
