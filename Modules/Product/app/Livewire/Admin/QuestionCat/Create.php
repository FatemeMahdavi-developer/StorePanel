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

    public function save(){
        $inputs=$this->validate();
        $questionCat=questionCat::create($inputs);

        $questionCat->productCat()->sync($inputs['product_cats']);

        $this->resetExcept(['moduleTitle','model','productCat']);

        return $this->alert('success',__('admin.added_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('product::livewire.admin.question-cat.create',[
            'productCat'=>$this->productCat(),
            'product_cats'=>$this->product_cats
        ]);
    }
}
