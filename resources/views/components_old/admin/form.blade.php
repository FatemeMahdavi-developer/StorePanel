@props(["title"=>"","action"=>""])


<div class="flex flex-col gap-5.5 p-6.5">
@if(session()->has('message'))
<div class="bg-green-100 text-green-700 px-4 py-3 rounded relative" role="alert">
    <span class="block sm:inline">{{session('message')}}</span>
</div>
@endif
    <form wire:submit.prevent='{{$action}}'>
        {{$content ?? ""}}
    </form>
</div>
