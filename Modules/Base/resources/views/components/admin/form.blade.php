@props(['submit','has_File'=>false,'id'=>''])

<form wire:submit="{{$submit}}" @if($has_File) enctype="multipart/form-data" @endif @if($id) id="{{$id}}" @endif>
    @if(session()->has('message'))
        <div class="flex w-full border-r-6 border-[#34D399] bg-[#34D399] bg-opacity-[15%] px-2 py-4 shadow-md dark:bg-[#1B1B24] dark:bg-opacity-30">
            <div class="w-full">
                <p class="text-base leading-relaxed text-[#2d3747] dark:text-[#34D399]">{{session()->get('message')}}</p>
            </div>
          </div>
    @endif
    {{$slot}}
</form>
