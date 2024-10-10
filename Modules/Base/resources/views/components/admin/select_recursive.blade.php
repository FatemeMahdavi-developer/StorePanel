@props(['options'=>[],'label'=>'','class'=>'w-full','name'=>'','first_option'=>false, 'sub_method' => '','value'=>'','id'=>false,'ignore_id'=>0,'choose'=>false])

<div class="flex flex-col w-full">
<div class="mb-4.5 {{$class}}" wire:ignore>
    @if($label)<label class="">{{$label}}</label>@endif

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
      <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
        <svg
          class="fill-current"
          width="24"
          height="24"
          viewBox="0 0 24 24"
          fill="none"
          xmlns="http://www.w3.org/2000/svg">
          <g opacity="0.8">
            <path
              fill-rule="evenodd"
              clip-rule="evenodd"
              d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z"
              fill=""
            ></path>
          </g>
        </svg>
      </span>
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
