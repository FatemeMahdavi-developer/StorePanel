<?php
namespace Modules\Product\Livewire\Admin\QuestionCat;
use Modules\Base\Classes\Admin\ActionAll;
use Modules\Product\Models\Admin\questionCat;

class Index extends ActionAll
{
    public $items = [];
    public $selectAll = false;
    public int $paginate=3;
    public $moduleTitle;

    public function mount(){
        $this->moduleTitle='دسته بندی پارامتر';
    }

    public function checkAll()
    {
        $this->items = $this->selectAll ? $this->questionCat()->pluck('id')->toArray() : [];
    }

    public function actionAll($action,$field=''){
        if(!empty($field)){
            $this->action($action,questionCat::class,$this->$field);
            return $this->$field='';
        }else{
            return $this->action($action,questionCat::class);
        }
    }

    public function delete(questionCat $questionCat){
        $questionCat->delete();
    }

    // public function changeState(questionCat $questionCat){
    //     $state=($productbrand->state->value==StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
    //     $productbrand->update(['state'=>$state]);
    // }

    public function questionCat(){
        return questionCat::orderBy('id','DESC')->paginate($this->paginate);
    }

    public function render()
    {
        return view('product::livewire.admin.question-cat.index',[
            'questionCats'=>$this->questionCat()
        ]);
    }
}
