<?php
namespace Modules\Product\Livewire\Admin\Product;

use Modules\Base\Classes\Admin\ActionAll;
use Modules\Base\Enums\StateEnum;
use Modules\Product\Models\Admin\product;

class Index extends ActionAll
{
    public $items=[];
    public $selectAll=false;
    public int $paginate=3;
    public $moduleTitle;

    public function mount(){
        $this->moduleTitle='محصول';
    }

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->products()->pluck('id')->toArray() : [];
    }

    public function actionAll($action,$field=''){
        if(!empty($field)){
            $this->action($action,product::class,$this->$field);
            return $this->$field='';
        }else{
            return $this->action($action,product::class);
        }
    }

    public function delete(product $product){
        $product->delete();
    }

    public function changeState(product $product){
        $state=($product->state->value==StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
        $product->update(['state'=>$state]);
    }

    public function products(){
        return product::orderBy('id','DESC')->paginate($this->paginate);
    }

    public function render()
    {
        return view('product::livewire.admin.product.index',[
            'products'=>$this->products()
        ]);
    }
}
