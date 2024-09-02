@props(["title"=>"","action"=>""])
<div class="mx-auto max-w-screen-2xl p-4 sm:p-6 2xl:p-10">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-sm2 font-bold text-black dark:text-white">{{$title}}</h2>
    </div>
    <div class="grid grid-cols-1 gap-9 mb-12">
        <div class="flex flex-col gap-9">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
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
        </div>
        </div>
        </div>
    </div>
    </div>

