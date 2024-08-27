@props(['name'=>'','options'=>[],'class'=>'','first_option'=>false,'value_first_option'=>'','sub_method' => '','value'=>'','id'=>false,'ignore_id'=>0,'choose'=>false])

<select wire:model="{{$name}}" id="{{$name}}" class="relative z-20 w-1/2 appearance-none rounded border border-stroke bg-transparent py-3 pl-5 pr-12 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input"
    :class="isOptionSelected && 'text-black dark:text-white'" @change="isOptionSelected=true">

    @if($first_option)
        <option @if(empty($value_first_option)) value="" @else value="{{$value_first_option}}" @endif >{{$first_option}}</option>
    @endif
    @if($choose)
        <option value="">انتخاب کنید</option>
    @endif
    @if(isset($options[0]))
        @foreach($options as $option)
            @if($ignore_id)
                @if($option['id'] != $ignore_id)
                    <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif class="text-body">{{$option["title"]}}</option>
                    <x-admin.sub_option :options="$option" :method="$sub_method" :value="$value" ></x-admin.sub_option>
                @endif
            @else
                <option value="{{$option["id"]}}" @if($option['id'] == $value) selected @endif class="text-body">{{$option["title"]}}</option>
                <x-admin.sub_option :options="$option" :method="$sub_method" :value="$value" ></x-admin.sub_option>
            @endif
        @endforeach
    @endif
</select>


