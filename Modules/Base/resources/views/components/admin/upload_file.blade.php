@props(['title'=>'','name'=>'','value'=>'','dir'=>'rtl','class'=>'w-50','module'=>false,'updatingValue'=>''])

<div class="flex flex-col">
    <div>
        @if($title)
            <label class="mb-3 block text-sm font-medium text-black dark:text-white">{{$title}}</label>
        @endif
      <input type="file" wire:model="{{$name}}" id="{{$name}}" class="w-1/2 cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary">

       @if($updatingValue)
       <div class="inline-block">
           {{$content}}
       </div>


        @elseif(!is_null($value) && !empty($value))
            <div class="show_image" style="display: inline;">
                @if(in_array(pathinfo($value,PATHINFO_EXTENSION),config('base.img_extension')))
                    <img src="{{asset($value)}}" height="40px" class="rounded">
                    <a href="javascript:void(0)" wire:click="deleteImage"class="delete_img"><img src="{{asset("admin/assets/img/delete.svg")}}"></a>
                @elseif(in_array(pathinfo($value,PATHINFO_EXTENSION),config('base.video_extention')))
                    <a href="{{asset($value)}}" target="_blank">مشاهده ویدیو</a>
                    <a href="javascript:void(0)" wire:click="deleteVideo"class="delete_img"><img src="{{asset("admin/assets/img/delete.svg")}}"></a>
                @endif
            </div>
        @endif

    </div>
    @error($name)<br><span class="text text-danger">{{$message}}</span> @enderror
</div>






