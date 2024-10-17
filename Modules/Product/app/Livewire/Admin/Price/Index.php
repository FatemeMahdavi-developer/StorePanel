<?php

namespace Modules\Product\Livewire\Admin\Price;

use Modules\Base\Classes\Admin\ActionAll;
use Modules\Base\Enums\StateEnum;
use Modules\Product\Models\Admin\Product;
use Modules\Product\Models\Admin\productPrice;

class Index extends ActionAll
{
    public $items=[];
    public $selectAll=false;
    public int $paginate=3;
    public $moduleTitle;
    public $product;

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->product_price()->pluck('id')->toArray() : [];
    }
    public function mount(Product $product){
        $this->moduleTitle='قیمت محصول';
        $this->product=$product;
        // $this->productPrices=$product->price()->paginate($this->paginate);
    }
    public function product_price(){
        return $this->product->price()->orderBy('id','asc')->paginate($this->paginate);;
    }
    public function changeState(productPrice $productPrice){
        $price_active=($productPrice->price_active->value==StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
        $productPrice->update(['price_active'=>$price_active]);
    }    
    public function delete(productPrice $productPrice){
        $productPrice->delete();
    }
    public function actionAll($action,$field=''){
        if(!empty($field)){
            $this->action($action,productPrice::class,$this->$field);
            return $this->$field='';
        }else{
            return $this->action($action,productPrice::class);
        }
    }
    
    public function render()
    {
        return view('product::livewire.admin.price.index',['productPrices'=>$this->product_price()]);
    }
}
