<?php

namespace Modules\Product\Livewire\Admin\Question;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Modules\Base\Traits\UpdatingValidation;
use Modules\Product\Enums\TypeEnum;
use Modules\Product\Http\Requests\Admin\QuestionValidation;
use Modules\Product\Models\Admin\Question;
use Modules\Product\Models\Admin\questionCat;
use Modules\Product\Models\Admin\questionItems;

class Edit extends Component
{
    use LivewireAlert,UpdatingValidation;
    public $title,$moduleTitle,$model,$parent_id,$type,$question_cat_id,$question;
    public $items=[];
    public $question_cats=[];

    public function mount($question){
        $this->moduleTitle=config('product.questionModuleTitle');
        $this->model=Question::class;
        $this->question=$question;
        $this->title=$this->question->title;
        $this->type=$this->question->type;
        $this->question_cat_id=$this->question->question_cat_id;
        $this->items=$this->question->items()->pluck('value')->toArray();
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


    public function update(){
        $inputs=$this->validate();
        $items=$inputs['items'];
        $question=$this->question->update($inputs);

        $existingItems = questionItems::where('question_id', $this->question->id)->pluck('value')->toArray();


        $upsertData = collect($items)->map(function($item) use ($question) {
            return [
                'question_id'=>$this->question->id,
                'value' => $item,
            ];
        })->toArray();

        questionItems::upsert($upsertData,uniqueBy:['question_id','value'],update:['value']);

        $itemsToDelete = array_diff($existingItems, $items);
        questionItems::where('question_id', $this->question->id)
                     ->whereIn('value', $itemsToDelete)
                     ->delete();
                     
        $this->resetExcept(['moduleTitle','model','product_brands']);
        return $this->alert('success',__('admin.added_successfully',['module' => $this->moduleTitle]), [
            'position' => 'top-end',
        ]);
    }

    public function render()
    {
        return view('product::livewire.admin.question.edit',[
            'questionCat'=>$this->questionCat(),
            'typeItems'=>$this->typeItems()
        ]);
    }
}
