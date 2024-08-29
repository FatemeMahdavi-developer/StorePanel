<?php

namespace Modules\ProductCat\Livewire\Admin;

use App\trait\admin\SlugMethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ProductCat\Models\ProductCat;

class Create extends Component
{
    use WithFileUploads,SlugMethod;
    public $parent_id;
    public $seo_url,$seo_title,$title,$note,$pic,$path_pic='';

    public string $module='';
    public string $module_name='';

    public function mount()
    {
        $this->module='product_cat';
        $this->module_name='دسته بندی محصول';
    }

    public function rules(){
        return [
            'seo_url' => ['required','string',Rule::unique('product_cats','seo_url')],
            'seo_title' => ['nullable'],
            'title' => ['required','min:3'],
            'pic' => ['nullable','image','mimes:png,jpeg,gif,svg','max:1024'],
            'parent_id'=>['nullable'],
            'note'=>['nullable','string']
        ];
    }

    protected function prepareForValidation($attribute){
        $attribute['seo_url']=self::SlugMethod($this->seo_url);
        return $attribute;
    }

    public function updatingPic($value){
        $this->pic=Storage::disk("public")->put("/".$this->module,$value);
        $this->path_pic=$this->pic;
    }

    public function save() {
        $inputs= $this->validate();
        if(empty($inputs['seo_title'])){
            $inputs['seo_title']=$this->title;
         }
         if(empty($inputs['seo_url'])){
            $inputs['seo_url']=str_replace(' ','-',$this->title);
         }
         if(!empty($inputs['pic'])){
            $inputs['pic']=$this->path_pic;
         }
         if(empty($inputs['parent_id'])){
            $inputs['parent_id']=null;
         }
        ProductCat::create($inputs);
        $this->reset(array_keys($inputs));
        session()->flash('message',__("admin.added_successfully",['attribute'=>$this->module_name]));
    }

    public function render()
    {
        $product_cats=ProductCat::where('parent_id',null)->with('sub_cats')->get();
        return view('productcat::livewire.admin.create',compact('product_cats'));
    }
}
