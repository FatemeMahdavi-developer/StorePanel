@props(['type'=>'text','title'=>'','name'=>'','placeholder'=>'','dir'=>'rtl','class'=>'','icon'=>''])

<div class="form-group {{$class}}">
    <div class="input-group">
        @if($icon)
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="{{$icon}}"></i></div>
        </div>
        @endif
        <input type="{{$type}}"  wire:model="{{$name}}" id="{{$name}}" class="form-control" @if($placeholder)placeholder="{{$placeholder}}"@endif>
    </div>
    @error($name)<span class="text text-danger">{{$message}}</span>@enderror
</div>
