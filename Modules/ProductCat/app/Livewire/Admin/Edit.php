<?php

namespace Modules\ProductCat\Livewire\Admin;

use App\trait\admin\SlugMethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Modules\ProductBrand\Models\ProductBrand;
use Modules\ProductCat\Models\ProductCat;

class Edit extends Component
{
    use WithFileUploads,SlugMethod;
    public $parent_id;
    public $seo_url,$seo_title,$title,$note,$pic,$path_pic='';
    public $brandids=[];
    public string $module='';
    public string $module_name='';

    public $product_cat;

    public function mount($productcat)
    {
        $this->module='product_cat';
        $this->module_name='دسته بندی محصول';
        $this->product_cat=$productcat;
        $this->brandids=$productcat->product_brand->pluck("id")->toArray();
        $this->seo_url=$this->product_cat->seo_url;
        $this->seo_title=$this->product_cat->seo_title;
        $this->title=$this->product_cat->title;
        $this->pic=$this->product_cat->pic;
        $this->note=$this->product_cat->note;
        $this->parent_id=$this->product_cat->parent_id;
    }


    public function updatingPic($value)
    {
        $this->pic=Storage::disk('public')->put('/'.$this->module,$value);
        $this->path_pic=$this->pic;

    }

    public function rules(){
        $rules=[
            'seo_url'=>['required','string',Rule::unique('product_cats','seo_url')->ignore($this->product_cat->id)],
            'seo_title'=>['nullable','string','min:3'],
            'title'=>['required','string','min:3','max:255'],
            'pic'=>['nullable','image','max:1024','mimes:jpg,jpeg,png,svg,webp,gif'],
            'parent_id'=>['nullable'],
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
        $this->product_cat->update($inputs);
        $this->product_cat->product_brand()->sync($this->brandids);
        session()->flash('message','با موفقیت آپدیت شد');
        // return back()->with(['message'=>'با موفقیت آپدیت شد']);
    }


    public function render()
    {
        $product_cats=ProductCat::where('parent_id',null)->with('sub_cats')->get();
        $product_brands=ProductBrand::get(['id','title']);
        return view('productcat::livewire.admin.edit',compact('product_cats','product_brands'));
    }
}
