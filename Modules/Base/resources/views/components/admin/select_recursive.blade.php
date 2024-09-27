@props(['options'=>[],'label'=>'','class'=>'w-50','name'=>'','first_option'=>false, 'sub_method' => '','value'=>'','id'=>false,'ignore_id'=>0,'choose'=>false])
<div class="form-group {{$class}}" wire:ignore @if($id) id="{{$id}}" @endif>
    @if($label)<label class="control-label">{{$label}}</label>@endif
    <select class="form-control" wire:model="{{$name}}" id="{{$name}}">
        @if($first_option)
            <option value="">{{$first_option}}</option>
        @endif
        @if($choose)
            <option value="">انتخاب کنید</option>
        @endif
        @if(isset($options[0]))
            @foreach($options as $option)
                @if($ignore_id)
                    @if($option['id'] != $ignore_id)
                        <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                        <x-base::admin.sub_option
                            :options="$option"
                            :method="$sub_method"
                            :$value >
                        </x-base::admin.select_recursive>
                    @endif
                @else
                    <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                    <x-base::admin.sub_option
                        :options="$option"
                        :method="$sub_method"
                        :$value >
                    </x-base::admin.select_recursive>
                @endif
            @endforeach
        @endif
    </select>
</div>
<div>
    @error($name)<span class="text text-danger">{{$message}}</span>@enderror
</div>


@if(!empty($value))
    <script>
        var select = document.getElementById('{{$name}}');
        select.value='{{$value}}';
    </script>
@endif

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
