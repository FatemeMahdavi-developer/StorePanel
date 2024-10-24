@props(['title'=>'','name'=>'','options'=>[],'key'=>'','val'=>'','value'=>'','placeholder'=>'انتخاب کنید','class'=>'w-50','ClickAction'=>'','select2'=>true,'id'=>'',
'sub_method'=>'','wire_click'=>''])

<div class="rounded-sm dark:border-strokedark dark:bg-boxdark">
    <label class="mb-3 block text-sm font-medium text-black dark:text-white" for="{{$name}}">دسته بندی محصولات</label>
    <div class="flex flex-col gap-5.5 p-3">
        @foreach($options as $cats)
            <div @if(in_array($cats->id,$value)) x-data="{checkboxToggle: true}" @else x-data="{checkboxToggle: false}" @endif  >
            <label for="{{$cats->id}}" class="flex cursor-pointer select-none items-center text-sm font-medium">
                <div class="relative">
                    <input type="checkbox" wire:model.live="{{$name}}" id="{{$cats->id}}" value="{{$cats->id}}"
                    @if($wire_click) wire:click="selectedSubCat({{$cats->id}})" @endif class="sr-only" @change="checkboxToggle = !checkboxToggle"/>
                    <div :class="checkboxToggle && 'border-primary bg-gray dark:bg-transparent'" class="mr-4 flex h-5 w-5 items-center justify-center rounded border">
                        <span :class="checkboxToggle && '!opacity-100'" class="opacity-0"><svg width="11" height="8" viewBox="0 0 11 8" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M10.0915 0.951972L10.0867 0.946075L10.0813 0.940568C9.90076 0.753564 9.61034 0.753146 9.42927 0.939309L4.16201 6.22962L1.58507 3.63469C1.40401 3.44841 1.11351 3.44879 0.932892 3.63584C0.755703 3.81933 0.755703 4.10875 0.932892 4.29224L0.932878 4.29225L0.934851 4.29424L3.58046 6.95832C3.73676 7.11955 3.94983 7.2 4.1473 7.2C4.36196 7.2 4.55963 7.11773 4.71406 6.9584L10.0468 1.60234C10.2436 1.4199 10.2421 1.1339 10.0915 0.951972ZM4.2327 6.30081L4.2317 6.2998C4.23206 6.30015 4.23237 6.30049 4.23269 6.30082L4.2327 6.30081Z" fill="#3056D3" stroke="#3056D3" stroke-width="0.4"></path> </svg></span>
                    </div>
                </div>
                <span class="pr-2">{{$cats->title}}</span>
            </label>
            </div>
            @if(isset($cats->$sub_method))
            @foreach($cats->$sub_method as $cat)
                <x-base::admin.sub_option_checkbox_recursive name="{{$name}}" :options="$cat" sub_method="{{$sub_method}}" :value="$value"  ></x-base::admin.sub_option_checkbox_recursive>
            @endforeach
            @endif
        @endforeach
    </div>
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>


