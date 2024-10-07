
<div class="mx-auto max-w-screen-2xl p-4 sm:p-6 2xl:p-10">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-sm2 font-bold text-black dark:text-white">افزودن {{$moduleTitle}} </h2>
    </div>
    <div class="grid grid-cols-1 gap-9 mb-12">
        <div class="flex flex-col gap-9">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-col gap-5.5 p-6.5">
            <x-base::admin.form submit="save" has_File="true">

                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="title" title="عنوان" isLive="true"></x-base::admin.input>
                </div>

                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="seo_url" title="آدرس سئو" ></x-base::admin.input>
                    <x-base::admin.input name="seo_title" title="عنوان سئو" ></x-base::admin.input>
                </div>
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.upload_file name="image" title="تصویر" :updatingValue="$pathImage" >
                        @slot('content')
                            @if($pathImage)
                                <span class="flex items-center justify-center rounded-full">
                                    <img src="{{$pathImage->temporaryUrl()}}" class="rounded-full h-[100px]">
                                </span>
                            @endif
                        @endslot
                    </x-base::admin.input>
                </div>
                <x-base::admin.select2_multiple name="product_brands_selected" title="برند" :items="$product_brands" ></x-base::admin.input>

                <x-base::admin.ckeditor name="note" title="توضیحات"></x-base::admin.ckeditor>

                <x-base::admin.button title="ارسال" ></x-base::admin.button>

                </x-base::admin.form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

