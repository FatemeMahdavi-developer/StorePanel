@props(["state"=>"disable","id"=>""])
<div @if($state=='disable')x-data="{ switcherToggle: false }"@else x-data="{ switcherToggle: true }" @endif>
    <label for="toggle1" class="flex cursor-pointer select-none items-center" >
      <div class="relative">
        <input
          type="checkbox"
          id="toggle1"
          class="sr-only"
          @change="switcherToggle = !switcherToggle" wire:click="change_state({{$id}})" />
        <div
          class="block h-8 w-14 rounded-full bg-meta-9 dark:bg-[#5A616B]"
        ></div>
        <div
          :class="switcherToggle && '!translate-x-full !bg-primary dark:!bg-white'"
          class="absolute left-1 top-1 h-6 w-6 rounded-full bg-white transition"
        ></div>
      </div>
    </label>
  </div>