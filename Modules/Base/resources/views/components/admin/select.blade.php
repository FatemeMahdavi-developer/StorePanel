@props(['title'=>'','name'=>'','items'=>[],'key'=>'','val'=>'','value'=>'','placeholder'=>'انتخاب کنید','class'=>'w-50','ClickAction'=>'','select2'=>true,'id'=>''])

<div class="form-group {{$class}}" @if($select2===true) wire:ignore @endif>
    @if($title) <label>{{$title}}</label> @endif
    <select @if($ClickAction) wire:change="{{$ClickAction}}" @endif wire:model="{{$name}}" @if($id) id="{{$id}}" @else id="{{$name}}" @endif class="form-control">
        <option value="">{{$placeholder}}</option>
        @foreach($items as $key_item => $value_item)
            <option @if(empty($key))value="{{$key_item}}" @else value="{{$value_item[$key]}}" @endif>
                @if(empty($val)){{$value_item}}@else{{$value_item[$val]}} @endif
            </option>
        @endforeach
    </select>
</div>
<div>
    @error($name)<span class="text text-danger">{{$message}}</span>@enderror
</div>


@if(!empty($value))
    <script>
        if(empty("{{$id}}")){
            document.getElementById("{{$name}}").value='{{$value}}';
        }else{
            document.getElementById("{{$id}}").value='{{$value}}';
        }
    </script>
@endif

@if($select2===true)
    @section('footer')
    <script>
        $(document).ready(function(){
            setTimeout(() => {
                $("#{{$name}}").select2();
                $("#{{$name}}").on('change',function(e){
                    @this.set("{{$name}}", e.target.value);
                })
            }, 1000);
        });
    </script>
    @endsection
@endif
