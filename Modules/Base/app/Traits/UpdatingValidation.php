<?php

namespace Modules\Base\Traits;

trait UpdatingValidation
{
    public function rules()
    {
        return $this->validationClass()::rules();
    }

     protected function prepareForValidation($attributes): array
     {
        // if(method_exists($this->validationClass(),'prepareForValidation')){
            return $this->validationClass()::prepareForValidation($attributes);
        // }
        // return [];
     }

     public function updated($propertyName)
     {
         $this->validateOnly($propertyName);
     }

    public function updatedImage($value)
    {
         $validationClass = $this->validationClass();
         $this->pathImage = '';
         $this->validate([
            'image' => $validationClass::rules()['image'],
         ]);
         $this->image = $value;
         $this->pathImage = $value;
    }
}
