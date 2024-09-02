<?php

namespace Modules\ProductBrand\Livewire\Admin;

use App\trait\admin\SlugMethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Modules\ProductBrand\Models\ProductBrand;

class Edit extends Component
{
    use WithFileUploads,SlugMethod;
    public $parent_id;
    public $seo_url,$seo_title,$title,$note,$pic,$path_pic='';
    // public $brandids=[];
    public string $module='';
    public string $module_name='';

    public $productـbrand;

    public function mount($brand)
    {
        $this->module='productـbrand';
        $this->module_name='دسته بندی محصول';
        $this->productـbrand=$brand;
        $this->seo_url=$this->productـbrand->seo_url;
        $this->seo_title=$this->productـbrand->seo_title;
        $this->title=$this->productـbrand->title;
        $this->pic=$this->productـbrand->pic;
        $this->note=$this->productـbrand->note;
        $this->parent_id=$this->productـbrand->parent_id;
    }


    public function updatingPic($value)
    {
        $this->pic=Storage::disk('public')->put('/'.$this->module,$value);
        $this->path_pic=$this->pic;

    }

    public function rules(){
        $rules=[
            'seo_url'=>['required','string',Rule::unique('product_brands','seo_url')->ignore($this->productـbrand->id)],
            'seo_title'=>['nullable','string','min:3'],
            'title'=>['required','string','min:3','max:255'],
            'pic'=>['nullable','image','max:1024','mimes:jpg,jpeg,png,svg,webp,gif'],
            'note'=>['nullable','string']
        ];
       if(is_string($this->pic) &&  in_array(pathinfo($this->pic,PATHINFO_EXTENSION),['jpeg','png','jpg','gif','svg','webp'])){
            unset($rules['pic']);
       }
        return $rules;
    }

    protected function prepareForValidation($attribute){
        $attribute['seo_url']=$this->SlugMethod($this->seo_url);
        return $attribute;
    }

    public function updating($property,$value)
    {
        if($property=="parent_id"){
            $this->parent_id = $value;
        }
    }

    public function update(){
        $inputs=$this->validate();
        if(empty($inputs['parent_id'])){
            $inputs['parent_id']=null;
        }
        if(!empty($inputs['pic'])){
            $inputs['pic']=$this->path_pic;
        }
        $this->productـbrand->update($inputs);
        session()->flash('message','با موفقیت آپدیت شد');
    }


    public function render()
    {
        $productـbrands=ProductBrand::all();
        return view('productbrand::livewire.admin.edit',compact('productـbrands'));
    }
}
