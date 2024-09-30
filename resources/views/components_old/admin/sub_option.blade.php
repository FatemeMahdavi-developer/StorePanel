@props(['options'=>[], 'method'=>'', 'level_sep'=>'- ', 'level_txt'=>'','value'=>''])
@php $sub_options = $options->{$method}; $level_txt .= $level_sep; @endphp
@if(!empty($sub_options[0]))
    @foreach($sub_options as $opt)
        <option value="{{$opt["id"]}}" @if($opt['id'] == $value) selected @endif class="text-body">{{$level_txt}} {{$opt["title"]}}</option>
        <x-admin.sub_option :options="$opt" :method="$method" :level_sep="$level_sep" level_txt="$level_txt"></x-admin.sub_option>
    @endforeach
@endif
