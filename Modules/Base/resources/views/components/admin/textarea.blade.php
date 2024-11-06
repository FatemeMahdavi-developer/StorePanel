@props(['title'=>'','name'=>'','placeholder'=>'','value'=>'','class'=>''])

<div class="form-group {{$class}}">
    @if($title)
        <label for="{{$name}}">{{$title}}</label>
    @endif
    <textarea wire:model="{{$name}}" id="{{$name}}" class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary">{{$value}}</textarea>
    @error($name)<span class="text text-danger">{{$message}}</span>@enderror
</div>
