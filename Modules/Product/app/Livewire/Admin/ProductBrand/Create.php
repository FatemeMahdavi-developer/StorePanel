<?php

namespace Modules\Product\Livewire\Admin\ProductBrand;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Modules\Product\Models\Admin\ProductBrand;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Create extends Component
{
    use WithFileUploads,AuthorizesRequests;

    public $seo_url,$seo_title,$title,$image,$pathImage,$note,$moduleTitle,$model;

    public function mount(){
        $this->moduleTitle='برند محصول';
        $this->model=ProductBrand::class;
        // $this->authorize('create',$this->model);
    }

    public function rules(){
        return[
            'seo_url' => ['required','string',Rule::unique('product_brands','seo_url')],
            'seo_title' => ['required','min:3','max:100'],
            'title' => ['required','min:3'],
            'image' => ['nullable','image','mimes:png,jpeg,gif,svg','max:1024'],
            'note'=>['nullable','string']
        ];
    }

    protected function prepareForValidation($attributes): array
    {
        $attributes['seo_url']=Str::slug($attributes['seo_url'],'-',null);
        return $attributes;
    }

    public function updatedImage($value){
        $this->pathImage='';
        $this->validate([
            'image' => $this->rules()['image']
        ]);
        $this->image=$value;
        $this->pathImage=$value;
    }

    public function save(){
        $inputs=$this->validate();
        $productBrand=ProductBrand::create($inputs);
        if(!empty($this->image)){
            $productBrand->addMedia($this->image)->toMediaCollection('image');
        }
        $this->reset();
        return back()->with('message', __('admin.added_successfully', [
            'attribute' =>$this->moduleTitle
        ]));
    }

    public function render()
    {
        return view('product::livewire.admin.product-brand.create',[
            'moduleTitle'=>$this->moduleTitle
        ]);
    }
}
