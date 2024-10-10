
<div class="mx-auto max-w-screen-2xl p-4 sm:p-6 2xl:p-10">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-sm2 font-bold text-black dark:text-white">ویرایش {{$moduleTitle}} </h2>
    </div>
    <div class="grid grid-cols-1 gap-9 mb-12">
        <div class="flex flex-col gap-9">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-col gap-5.5 p-6.5">
            <x-base::admin.form submit="update" has_File="true">
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="title" title="عنوان" isLive="true"></x-base::admin.input>
                </div>
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="seo_url" title="آدرس سئو"></x-base::admin.input>
                    <x-base::admin.input name="seo_title" title="عنوان سئو" ></x-base::admin.input>
                </div>
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.upload_file name="image" title="تصویر" :updatingValue="$pathImage"  :value="$image">
                        @slot('content')
                            @if($pathImage)
                                <span class="flex items-center justify-center rounded-full">
                                    <img src="{{$pathImage->temporaryUrl()}}" class="rounded-full h-[100px]">
                                </span>
                            @endif
                        @endslot
                    </x-base::admin.input>
                </div>
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.select_recursive choose="انتخاب کنید" name="cat_id" :value="$cat_id" label="دسته بندی" :options="$productCats" ></x-base::admin.select_recursive>
                    <div class="flex flex-col w-full">
                        <div class="w-full">
                            <label class="mb-3 block text-sm font-medium text-black dark:text-white">برند</label>
                            <div class="relative z-20 bg-transparent dark:bg-form-input">
                            <select wire:model.live="brand_id" id="brand_id" class="relative z-20 w-full appearance-none rounded border border-stroke bg-transparent px-5 py-3 outline-none transition focus:border-primary active:border-primary dark:border-form-strokedark dark:bg-form-input dark:focus:border-primary">
                                <option value="" class="text-body">انتخاب کنید</option>
                                @if(@$productBrands)
                                    @foreach($productBrands as $key=>$value)
                                        <option class="text-body" value="{{$key}}">{{$value}}</option>
                                    @endforeach
                                @endif
                            </select>
                            <span class="absolute right-4 top-1/2 z-30 -translate-y-1/2">
                                <svg class="fill-current" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g opacity="0.8"><path fill-rule="evenodd" clip-rule="evenodd" d="M5.29289 8.29289C5.68342 7.90237 6.31658 7.90237 6.70711 8.29289L12 13.5858L17.2929 8.29289C17.6834 7.90237 18.3166 7.90237 18.7071 8.29289C19.0976 8.68342 19.0976 9.31658 18.7071 9.70711L12.7071 15.7071C12.3166 16.0976 11.6834 16.0976 11.2929 15.7071L5.29289 9.70711C4.90237 9.31658 4.90237 8.68342 5.29289 8.29289Z" fill="" ></path></g>
                                </svg>
                            </span>
                            </div>
                        </div>
                        <div>
                            @error('brand_id')<span class="text text-danger">{{$message}}</span>@enderror
                        </div>
                        @if($brand_id)
                        <script>
                              var select=document.getElementById('brand_id');
                              select.value="{{$brand_id}}";
                        </script>
                        @endif
                    </div>
                </div>
                <x-base::admin.ckeditor name="note" title="توضیحات" :value="$note" ></x-base::admin.ckeditor>
                <x-base::admin.button title="ارسال" ></x-base::admin.button>
                </x-base::admin.form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
{{--
@if(!empty($brand_id))
@dump($brand_id)
<script>
    var select=document.getElementById('brand_id');
    select.value="{{$brand_id}}";
</script>
@endif
 --}}
