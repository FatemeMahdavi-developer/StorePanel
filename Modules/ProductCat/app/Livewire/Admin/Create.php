<?php

namespace Modules\ProductCat\Livewire\Admin;

use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Modules\ProductCat\Models\ProductCat;

class Create extends Component
{
    use WithFileUploads;
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
        $attribute['seo_url']=self::sluggableCustomSlugMethod($this->seo_url);
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

    public function sluggableCustomSlugMethod($string, $separator = '-')
    {
        $_transliteration = array(
            '/ä|æ|ǽ/' => 'ae',
            '/ö|œ/' => 'oe',
            '/ü/' => 'ue',
            '/Ä/' => 'Ae',
            '/Ü/' => 'Ue',
            '/Ö/' => 'Oe',
            '/À|Á|Â|Ã|Å|Ǻ|Ā|Ă|Ą|Ǎ/' => 'A',
            '/à|á|â|ã|å|ǻ|ā|ă|ą|ǎ|ª/' => 'a',
            '/Ç|Ć|Ĉ|Ċ|Č/' => 'C',
            '/ç|ć|ĉ|ċ|č/' => 'c',
            '/Ð|Ď|Đ/' => 'D',
            '/ð|ď|đ/' => 'd',
            '/È|É|Ê|Ë|Ē|Ĕ|Ė|Ę|Ě/' => 'E',
            '/è|é|ê|ë|ē|ĕ|ė|ę|ě/' => 'e',
            '/Ĝ|Ğ|Ġ|Ģ/' => 'G',
            '/ĝ|ğ|ġ|ģ/' => 'g',
            '/Ĥ|Ħ/' => 'H',
            '/ĥ|ħ/' => 'h',
            '/Ì|Í|Î|Ï|Ĩ|Ī|Ĭ|Ǐ|Į|İ/' => 'I',
            '/ì|í|î|ï|ĩ|ī|ĭ|ǐ|į|ı/' => 'i',
            '/Ĵ/' => 'J',
            '/ĵ/' => 'j',
            '/Ķ/' => 'K',
            '/ķ/' => 'k',
            '/Ĺ|Ļ|Ľ|Ŀ|Ł/' => 'L',
            '/ĺ|ļ|ľ|ŀ|ł/' => 'l',
            '/Ñ|Ń|Ņ|Ň/' => 'N',
            '/ñ|ń|ņ|ň|ŉ/' => 'n',
            '/Ò|Ó|Ô|Õ|Ō|Ŏ|Ǒ|Ő|Ơ|Ø|Ǿ/' => 'O',
            '/ò|ó|ô|õ|ō|ŏ|ǒ|ő|ơ|ø|ǿ|º/' => 'o',
            '/Ŕ|Ŗ|Ř/' => 'R',
            '/ŕ|ŗ|ř/' => 'r',
            '/Ś|Ŝ|Ş|Ș|Š/' => 'S',
            '/ś|ŝ|ş|ș|š|ſ/' => 's',
            '/Ţ|Ț|Ť|Ŧ/' => 'T',
            '/ţ|ț|ť|ŧ/' => 't',
            '/Ù|Ú|Û|Ũ|Ū|Ŭ|Ů|Ű|Ų|Ư|Ǔ|Ǖ|Ǘ|Ǚ|Ǜ/' => 'U',
            '/ù|ú|û|ũ|ū|ŭ|ů|ű|ų|ư|ǔ|ǖ|ǘ|ǚ|ǜ/' => 'u',
            '/Ý|Ÿ|Ŷ/' => 'Y',
            '/ý|ÿ|ŷ/' => 'y',
            '/Ŵ/' => 'W',
            '/ŵ/' => 'w',
            '/Ź|Ż|Ž/' => 'Z',
            '/ź|ż|ž/' => 'z',
            '/Æ|Ǽ/' => 'AE',
            '/ß/' => 'ss',
            '/Ĳ/' => 'IJ',
            '/ĳ/' => 'ij',
            '/Œ/' => 'OE',
            '/ƒ/' => 'f'
        );
        $quotedReplacement = preg_quote($separator, '/');
        $merge = array(
            '/[^\s\p{Zs}\p{Ll}\p{Lm}\p{Lo}\p{Lt}\p{Lu}\p{Nd}]/mu' => ' ',
            '/[\s\p{Zs}]+/mu' => $separator,
            sprintf('/^[%s]+|[%s]+$/', $quotedReplacement, $quotedReplacement) => '',
        );
        $map = $_transliteration + $merge;
        unset($_transliteration);
        return preg_replace(array_keys($map), array_values($map), $string);
    }
    public function render()
    {
        $product_cats=ProductCat::where('parent_id',null)->with('sub_cats')->get();
        return view('productcat::livewire.admin.create',compact('product_cats'));
    }
}
