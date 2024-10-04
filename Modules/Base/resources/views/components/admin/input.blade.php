@props(['type'=>'text','title'=>'','name'=>'','id'=>'','placeholder'=>'','dir'=>'rtl','class'=>'w-full sm:w-1/2','isLive'=>false])

<div class="{{$class}}">
    @if($title)
        <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="{{$name}}">{{$title}}</label>
    @endif
    <input type="{{$type}}" @if($isLive) wire:model.live="{{$name}}" @else wire:model="{{$name}}" @endif @if($id) id="{{$id}}" @else id="{{$name}}" @endif @if($placeholder)placeholder="{{$placeholder}}"@endif class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" >
    @error($name)<div class="text-red-600">{{$message}}</div>@enderror
</div>
