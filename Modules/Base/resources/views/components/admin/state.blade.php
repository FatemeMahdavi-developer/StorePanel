@props(["state"=>"disable","id"=>"","methodName"=>""])
<div>
    <label class="flex cursor-pointer select-none items-center" >
    <div class="relative">
        <input type="checkbox" class="sr-only" wire:click="{{$methodName}}" />
        <div class="block h-8 w-14 rounded-full bg-meta-9 dark:bg-[#5A616B]"></div>
        <div class="absolute left-1 top-1 h-6 w-6 rounded-full  transition
        @if($state=='active')bg-primary !translate-x-full @else  bg-white @endif "></div>
    </div>
    </label>
</div>
