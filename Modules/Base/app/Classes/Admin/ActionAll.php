<?php

namespace Modules\Base\Classes\Admin;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Base\Enums\StateEnum;

class ActionAll extends Component
{
    use WithPagination,LivewireAlert;

    public $items=[];
    public $selectAll=false;
    public $model;
    public mixed $field;
    public string $ModuleTitle='';

    public function __construct(public string $countPage='')
    {
        $this->countPage=config('base.count_page');
    }

    public function action($action,$model,$field='')
    {
        if (method_exists(self::class, $action)) {
            if(empty($this->items)){
                return $this->alert('error',__('common.msg.choose'), [
                    'position' => 'top-end',
                ]);
            }
            $this->model=$model;
            $this->field=$field;
            if(!empty($field)){
                return $this->$action($model,$field);
            }else{
                return $this->$action($model);
            }
        } else {
            return false;
        }
    }

    public function confirmedAll(){
        $this->model::whereIn('id',$this->items)->delete();
        $this->reset("selectAll","items");
    }

    public function ConfirmedForceDeleteAll(){
        $this->model::onlyTrashed()->whereIn('id',$this->items)->forceDelete();
        $this->reset("selectAll","items");
    }

    public function getListeners()
    {
        return [
            'confirmedAll',
            'ConfirmedForceDeleteAll'
        ];
    }

    public function deleteAll($model){
        $this->confirm(__('common.msg.is_delete'), [
            'confirmButtonText' => 'بله',
            'cancelButtonText' => 'خیر',
            'icon'=>'',
            'onConfirmed' =>'confirmedAll',
            'confirmButtonColor' => '#67be7e',
        ]);
    }

    public function ForceDeleteAll($model){
        $this->confirm(__('common.msg.is_delete'), [
            'confirmButtonText' => 'بله',
            'cancelButtonText' => 'خیر',
            'icon'=>'',
            'onConfirmed' =>'ConfirmedForceDeleteAll',
            'confirmButtonColor' => '#67be7e',
        ]);
    }

    public function stateAll(){
        foreach($this->items as $id){
            $module=$this->model::findOrFail($id);
            $state=($module->state->value===StateEnum::ACTIVE->value) ? StateEnum::DISABLE->value : StateEnum::ACTIVE->value;
            $module->update(['state'=>$state]);
        }
        $this->reset("selectAll","items");
    }

    public function StateAllViaField(){
        foreach($this->items as $id){
            $module=$this->model::findOrFail($id);
            dd($this->field);
            if(!empty($this->field)){
                $module->update(['price_active'=>$this->field]);
            }
        }
        $this->reset("selectAll","items");
    }

    public function updatingPaginators(){
        $this->reset("selectAll","items");
    }


    
}
