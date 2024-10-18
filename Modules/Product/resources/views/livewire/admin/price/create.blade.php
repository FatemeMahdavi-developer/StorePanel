<div class="mx-auto max-w-screen-2xl p-4 sm:p-6 2xl:p-10">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-sm2 font-bold text-black dark:text-white">افزودن {{$moduleTitle}} </h2>
    </div>
    <div class="grid grid-cols-1 gap-9 mb-12">
        <div class="flex flex-col gap-9">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-col gap-5.5 p-6.5">
            <x-base::admin.form submit="save">
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="price" title="قیمت"></x-base::admin.input>
                    <x-base::admin.input name="discount" title="تخفیف"></x-base::admin.input>
                </div>
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="price_code" title="کد قیمت"></x-base::admin.input>
                    <x-base::admin.input name="number" title="تعداد"></x-base::admin.input>
                </div>

                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="numberlimit" title="حداقل موجودی"></x-base::admin.input>
                </div>
                <x-base::admin.button title="ارسال" ></x-base::admin.button>

                </x-base::admin.form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>
