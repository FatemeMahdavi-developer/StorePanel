@props(['title'=>'','name'=>'','placeholder'=>'','values'=>'','dir'=>'rtl','class'=>'w-50','module'=>false,'UpdatingValues'=>''])

<div class="form-group {{$class}}">
    <label for="{{$name}}">@if(!$module) {{$title}} @else {{$title}} {{getMaxSize($module,$name)}} @endif</label><br>
    <div class="custom-file ">
        <input type="file" wire:model.live="{{$name}}" id="{{$name}}" class="custom-file-input" multiple>
        <label class="custom-file-label" for="{{$name}}">انتخاب فایل</label>
    </div>
    @if($errors->has($name.'.*'))
        @foreach ($errors->get($name.'.*') as $message)
            @foreach ( $message as $value)
                <span class="text text-danger d-block">{{ $value }}</span>
            @endforeach
        @endforeach
    @endif
    @error($name)
        <span class="text text-danger d-block">{{$errors->first($name)}}</span>
    @enderror

    <div class="margin-10">
        @if($UpdatingValues)
            <div class="row gutters-sm">
                {{$content}}
            </div>
        @endif
        @if(!is_null($values) && !empty($values))
            <div class="row gutters-sm">
                @foreach ($values as $key=>$value)     
                    @if(in_array(pathinfo($value,PATHINFO_EXTENSION),config('base.img_extension')))
                    <div class="col-6 col-sm-3">
                        <label class="imagecheck mb-4">
                            <a href="javascript:void(0)" wire:click="deleteImages({{$key}})" class="delete_img"><img src="{{asset("admin/assets/img/delete.svg")}}"></a>
                            <img src="{{asset($value)}}" class="imagecheck-image" width="350px">
                        </label>
                    </div>
                    @endif
                @endforeach
            </div>
        @endif
    </div>
</div>