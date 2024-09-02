<div class="mx-auto max-w-screen-2xl p-4 sm:p-6 2xl:p-10">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-sm2 font-bold text-black dark:text-white">افزودن دسته بندی محصول</h2>
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
            <form wire:submit.prevent='update'>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">آدرس سئو</label>
                    <input type="text" wire:model='seo_url' class="w-1/2 rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"/>
                    @error("seo_url")<div class="text-red-600">{{$message}}</div>@enderror
                </div>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">عنوان سئو</label>
                    <input type="text" wire:model='seo_title' class="w-1/2 rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"/>
                    @error("seo_title")<div class="text-red-600">{{$message}}</div>@enderror
                </div>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white" >عنوان</label>
                    <input type="text" wire:model='title' class="w-1/2  rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary dark:disabled:bg-black"/>
                    @error("title")<div class="text-red-600">{{$message}}</div>@enderror
                </div>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">تصویر</label>
                    <input wire:model='pic' type="file" class="w-1/2 cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"/>
                    @if(!empty($path_pic))
                    <img src="{{asset("files/".$path_pic)}}" class="mx-auto h-12 inline rounded">
                    @elseif($pic)
                    <img src="{{asset("files/".$pic)}}" class="mx-auto h-12 inline rounded">
                    @endif
                    @error("pic")<div class="text-red-600">{{$message}}</div>@enderror
                </div>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">متن</label>
                    <textarea wire:model='note' rows="6" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
                    @error("note")<div class="text-red-600">{{$message}}</div>@enderror
                </div>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">دسته بندی</label>
                    <div x-data="{isOptionSelected:false}" class="relative z-20 bg-transparent">
                        <x-admin.select_recursive :options="$product_cats" name="parent_id" first_option="دسته بندی اصلی" sub_method="sub_cats"></x-admin.select_recursive>
                        @error("parent_id")<div class="text-red-600">{{$message}}</div>@enderror
                    </div>
                </div>
                <div class="my-3">
                    <label class="mb-3 block text-sm font-medium text-black dark:text-white">برند</label>
                    <select  wire:model="brandids" multiple id="countries_multiple" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>انتخاب کنید</option>
                        @foreach ($product_brands as $product_brand)
                            <option value="{{$product_brand["id"]}}" @if(in_array($product_brand["id"],$brandids)) selected @endif>{{$product_brand["title"]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="rounded-sm bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">ارسال</button>
                </div>
            </form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>






{{--
    <div class="text-center">
    @if($path_pic)
    <img src="{{asset("files/".$path_pic)}}" class="mx-auto h-12 w-12 text-gray-300">
    @elseif($pic)
    <img src="{{asset("files/".$pic)}}" class="mx-auto h-12 w-12 text-gray-300">


    @endif
--}}
