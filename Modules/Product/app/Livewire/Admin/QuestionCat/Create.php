<?php

namespace Modules\Product\Livewire\Admin\QuestionCat;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\QuestionCatValidation;
use Modules\Product\Models\Admin\productcat;
use Modules\Product\Models\Admin\questionCat;

class Create extends Component
{
    use LivewireAlert,UpdatingValidation;
    public $title,$moduleTitle,$model;
    public $product_cats=[];

    public function mount(){
        $this->moduleTitle=config('product.questionCatModuleTitle');
        $this->model=questionCat::class;
    }

    public function productCat(){
        return productcat::where('parent_id',null)->with('subCats')->get();
    }

    public function validationClass()
    {
        return QuestionCatValidation::class;
    }

    public function selectedSubCat(productcat $productcat){
        $a=productcat::where('parent_id',$productcat->id)->pluck('id')->toArray();
        $this->product_cats=array_merge([(int)$productcat->id],$a);
        // dd($this->product_cats);
    }

    // public function updatingProductCats($value)
    // {
    //     // dd($value);
    //     $a=productcat::where('parent_id',$value)->pluck('id')->toArray();
    //     $this->product_cats=array_merge([(int)$value],$a);
    // }



    public function updating($key,$value)
    {
        if($key=='product_cats.0'){
            $a=productcat::where('parent_id',$value)->pluck('id')->toArray();
            $this->product_cats=array_merge([(int)$value],$a);
            // dd($this->product_cats);
        }
    }

    public function save(){
        $input=$this->validate();
    }

    public function render()
    {
        return view('product::livewire.admin.question-cat.create',[
            'productCat'=>$this->productCat(),
            'product_cats'=>$this->product_cats
        ]);
    }
}
