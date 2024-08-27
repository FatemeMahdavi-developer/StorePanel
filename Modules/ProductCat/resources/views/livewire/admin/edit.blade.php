<div class="bg-gray-100 flex items-center justify-center" dir="rtl">
    <form class="mt-10" wire:submit.prevent='update'>
      <div class="space-y-12">
        <div class="border-b border-gray-900/10 pb-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">دسته بندی محصول</h2>
                @if(session()->has('message'))
                <p class="mt-1 text-sm leading-6 text-green-600"> {{ session('message') }}</p>
                @endif
                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                  <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">آدرس سئو</label>
                    <div class="mt-2">
                      <input type="text" wire:model='seo_url' class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error("seo_url")<div class="text-red-600">{{$message}}</div>@enderror
                  </div>
                  <div class="sm:col-span-3">
                    <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">عنوان سئو</label>
                    <div class="mt-2">
                      <input type="text"  wire:model='seo_title' class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error("seo_title")<div class="text-red-600">{{$message}}</div>@enderror
                  </div>

                  <div class="sm:col-span-4">
                    <label for="email" class="block text-sm font-medium leading-6 text-gray-900">عنوان</label>
                    <div class="mt-2">
                      <input type="text"  wire:model='title' class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    @error("title")<div class="text-red-600">{{$message}}</div>@enderror
                  </div>

                  <div class="sm:col-span-3">
                    <label for="country" class="block text-sm font-medium leading-6 text-gray-900">دسته بندی</label>
                    <div class="mt-2">
                        <x-admin.select_recursive :options="$product_cats" name="parent_id" first_option="دسته بندی اصلی" sub_method="sub_cats"></x-admin.select_recursive>
                    </div>
                    @error("parent_id")<div class="text-red-600">{{$message}}</div>@enderror
                  </div>
                </div>
              </div>
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
            <div class="col-span-full">
              <label for="about" class="block text-sm font-medium leading-6 text-gray-900">متن</label>
              <div class="mt-2">
                <textarea rows="3" wire:model="note" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"></textarea>
              </div>
              @error("note")<div class="text-red-600">{{$message}}</div>@enderror
            </div>
            <div class="col-span-full">
              <label for="cover-photo" class="block text-sm font-medium leading-6 text-gray-900">تصویر</label>
              <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10">
                <div class="text-center">
                    @if($path_pic)
                    <img src="{{asset("files/".$path_pic)}}" class="mx-auto h-12 w-12 text-gray-300">
                    @elseif($pic)
                    <img src="{{asset("files/".$pic)}}" class="mx-auto h-12 w-12 text-gray-300">
                    @else
                    <svg class="mx-auto h-12 w-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M1.5 6a2.25 2.25 0 012.25-2.25h16.5A2.25 2.25 0 0122.5 6v12a2.25 2.25 0 01-2.25 2.25H3.75A2.25 2.25 0 011.5 18V6zM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0021 18v-1.94l-2.69-2.689a1.5 1.5 0 00-2.12 0l-.88.879.97.97a.75.75 0 11-1.06 1.06l-5.16-5.159a1.5 1.5 0 00-2.12 0L3 16.061zm10.125-7.81a1.125 1.125 0 112.25 0 1.125 1.125 0 01-2.25 0z" clip-rule="evenodd" />
                    </svg>
                    @endif
                  <div class="mt-4 flex text-sm leading-6 text-gray-600">
                    <label for="file-upload" class="relative cursor-pointer rounded-md bg-white font-semibold text-indigo-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-600 focus-within:ring-offset-2 hover:text-indigo-500">
                      <span>upload</span>
                      <input id="file-upload" type="file" class="sr-only" wire:model='pic'>
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs leading-5 text-gray-600">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
            @error("pic")<div class="text-red-600">{{$message}}</div>@enderror
            </div>
          </div>
        </div>
      </div>
      <div class="mt-6 flex items-center justify-end gap-x-6">
        <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
      </div>
    </form>
</div>
