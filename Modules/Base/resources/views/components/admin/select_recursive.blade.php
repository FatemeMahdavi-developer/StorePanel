@props(['options'=>[],'title'=>'','class'=>'w-full','name'=>'','first_option'=>false, 'sub_method' => '','value'=>'','id'=>false,'ignore_id'=>0,'choose'=>false])

<div class="flex flex-col w-full">
<div class="{{$class}}" wire:ignore>
    @if($title)<label class="">{{$title}}</label>@endif
    <div x-data="{isOptionSelected: false}" class="relative z-20 bg-transparent dark:bg-form-input">
      <select  wire:model.live="{{$name}}" id="{{$name}}" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary"
        :class="isOptionSelected && 'text-black dark:text-white'"
        @change="isOptionSelected = true">

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
                        <option class="text-body" value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
                        <x-base::admin.sub_option
                            :options="$option"
                            :method="$sub_method"
                            :$value >
                        </x-base::admin.select_recursive>
                    @endif
                @else
                    <option class="text-body" value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif>{{$option["title"]}}</option>
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
</div>
<div>
    @error($name)<span class="text text-danger">{{$message}}</span>@enderror
</div>
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
