<?php

namespace Modules\Product\Livewire\Admin\Question;

use Illuminate\Validation\Rules\Enum;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Modules\Base\Enums\StateEnum;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Enums\TypeEnum;
use Modules\Product\Http\Requests\Admin\QuestionValidation;
use Modules\Product\Models\Admin\Question;
use Modules\Product\Models\Admin\question_items;
use Modules\Product\Models\Admin\questionCat;
use Modules\Product\Models\Admin\questionItems;

class Create extends Component
{
    use LivewireAlert,UpdatingValidation;
    public $title,$moduleTitle,$model,$parent_id,$type,$question_cat_id;
    public $items=[];
    public $question_cats=[];

    public function mount(){
        // $this->product_brands=ProductBrand::get(['id','title']);
        $this->moduleTitle=config('product.questionModuleTitle');
        $this->model=Question::class;
    }

    public function typeItems(){
        return collect(enumAsOptions(TypeEnum::cases(),app(Question::class)->enumsLang()))->pluck('label','value');
    }

    public function validationClass()
    {
        return QuestionValidation::class;
    }

    public function questionCat(){
        return questionCat::all()->pluck('title','id')->toArray();
    }

    public function save(){
        $inputs=$this->validate();
        $inputs['state']=StateEnum::DISABLE;
        $question=Question::create($inputs);

        $items=$inputs['items'];
        $upsertData = collect($items)->map(function($item) use ($question) {
            return [
                'question_id'=>$question->id,
                'value' => $item,
            ];
        })->toArray();

        questionItems::upsert($upsertData,uniqueBy:['question_id','value'],update:['value']);

        $this->resetExcept(['moduleTitle','model','product_brands']);
        return $this->alert('success',__('admin.added_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('product::livewire.admin.question.create',[
            'questionCat'=>$this->questionCat(),
            'typeItems'=>$this->typeItems()
            // 'product_cats'=>$this->product_cats
        ]);
    }



}
