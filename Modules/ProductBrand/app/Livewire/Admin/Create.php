<?php

namespace Modules\ProductBrand\Livewire\Admin;

use App\trait\admin\SlugMethod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ProductBrand\Http\Requests\product_brand_request;
use Modules\ProductBrand\Models\ProductBrand;
use Modules\ProductCat\Models\ProductCat;

class Create extends Component
{
    use WithFileUploads,SlugMethod;
    public $parent_id;
    public $seo_url,$seo_title,$title,$note,$pic,$path_pic='';
    public $catids=[];

    public string $module='';
    public string $module_name='';

    public function mount()
    {
        $this->module='product_brand';
        $this->module_name='برند محصول';
    }

    protected function prepareForValidation($attribute){
        $attribute['seo_url']=self::SlugMethod($this->seo_url);
        return $attribute;
    }

    public function updatingPic($value){
        $this->pic=Storage::disk("public")->put("/".$this->module,$value);
        $this->path_pic=$this->pic;
    }

    public function save(){
        $inputs= $this->validate(ProductBrand::rules());
        if(empty($inputs['seo_title'])){
            $inputs['seo_title']=$this->title;
         }
         if(empty($inputs['seo_url'])){
            $inputs['seo_url']=str_replace(' ','-',$this->title);
         }
         if(!empty($inputs['pic'])){
            $inputs['pic']=$this->path_pic;
         }
        $brand=ProductBrand::create($inputs);
        if(!empty($this->pic)){
            $brand->addMedia($this->pic)->toMediaCollection('images');
        }
        $this->reset(array_keys($inputs));
        session()->flash('message',__("admin.added_successfully",['attribute'=>$this->module_name]));
    }
    
    public function render()
    {
        return view('productbrand::livewire.admin.create');
    }
}
