@props(['title'=>'','name'=>'','value'=>'','class'=>''])
<div class="custom-control custom-checkbox {{$class}}">
    <input type="checkbox" value="1" @if($value=="1") checked @endif  wire:model="{{$name}}" class="custom-control-input" id="{{$name}}">
    <label class="custom-control-label" for="{{$name}}">{{$title}}</label>
    @error($name)<br><span class="text text-danger">{{$message}}</span>@enderror
</div>
