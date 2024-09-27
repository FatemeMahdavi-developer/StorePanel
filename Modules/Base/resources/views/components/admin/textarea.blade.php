@props(['title'=>'','name'=>'','placeholder'=>'','value'=>'','class'=>''])

<div class="form-group {{$class}}">
    @if($title)
        <label for="{{$name}}">{{$title}}</label>
    @endif
    <textarea wire:model="{{$name}}" id="{{$name}}" class="form-control">{{$value}}</textarea>
    @error($name)<span class="text text-danger">{{$message}}</span>@enderror
</div>
