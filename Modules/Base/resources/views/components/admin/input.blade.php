@props(['type'=>'text','title'=>'','name'=>'','placeholder'=>'','dir'=>'rtl','class'=>'my-3'])

<div class="{{$class}}">
    @if($title)
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">{{$title}}</label>
    @endif
    <input type="{{$type}}" wire:model="{{$name}}" dir="{{$dir}}" @if($placeholder)placeholder="{{$placeholder}}"@endif class="w-1/2 rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"/>
    @error($name)<div class="text-red-600">{{$message}}</div>@enderror
</div>
