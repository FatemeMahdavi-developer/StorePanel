
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
                    <x-base::admin.checkbox_recursive name="product_cats" wire_click="selectedSubCat" title="دسته بندی محصولات" :options="$productCat" sub_method="subCats" :value="$product_cats" ></x-base::admin.checkbox_recursive>
                </div>
                <x-base::admin.button title="ارسال" ></x-base::admin.button>
            </x-base::admin.form>
            </div>
        </div>
        </div>
        </div>
    </div>
  </div>
