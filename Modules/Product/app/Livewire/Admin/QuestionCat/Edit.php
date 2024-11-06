<?php

namespace Modules\Product\Livewire\Admin\QuestionCat;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Http\Requests\Admin\QuestionCatValidation;
use Modules\Product\Models\Admin\productcat;
use Modules\Product\Models\Admin\questionCat;

class Edit extends Component
{
    use LivewireAlert,UpdatingValidation;
    public $title,$moduleTitle,$model;
    public $product_cats=[];

    public $questioncat;

    public function mount(questionCat $questioncat){
        $this->moduleTitle=config('product.questionCatModuleTitle');
        $this->model=questionCat::class;
        $this->questioncat=$questioncat;
        $this->title=$questioncat->title;

        $this->product_cats=$questioncat->productCat()->pluck('id')->toArray();
    }

    public function productCat(){
        return productcat::where('parent_id',null)->with('subCats')->get();
    }

    public function validationClass()
    {
        return QuestionCatValidation::class;
    }

    public function update(){
        $inputs=$this->validate();

        $this->questioncat->update($inputs);

        $this->questioncat->productCat()->sync($inputs['product_cats']);

        return $this->alert('success',__('admin.edited_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('product::livewire.admin.question-cat.edit',[
            'productCat'=>$this->productCat(),
            'product_cats'=>$this->product_cats
        ]);
    }
}
