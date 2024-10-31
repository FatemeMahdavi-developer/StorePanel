<?php
namespace Modules\Product\Livewire\Admin\Question;

use Modules\Base\Classes\Admin\ActionAll;
use Modules\Base\Enums\StateEnum;
use Modules\Product\Models\Admin\Question;

class Index extends ActionAll
{
    public $items=[];
    public $selectAll=false;
    public int $paginate=3;
    public $moduleTitle;

    public function mount(){
        $this->moduleTitle='پارامتر';
    }

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->questions()->pluck('id')->toArray() : [];
    }

    public function actionAll($action,$field=''){
        if(!empty($field)){
            $this->action($action,Question::class,$this->$field);
            return $this->$field='';
        }else{
            return $this->action($action,Question::class);
        }
    }

    public function delete(Question $question){
        $question->delete();
    }

    public function changeState(Question $question){

        $state=($question->state->value==StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
        $question->update(['state'=>$state]);
    }

    public function questions(){
        return Question::orderBy('id','DESC')->paginate($this->paginate);
    }

    public function render()
    {
        return view('product::livewire.admin.question.index',[
            'questions'=>$this->questions()
        ]);
    }
}
