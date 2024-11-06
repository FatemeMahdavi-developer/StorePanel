
<div class="mx-auto max-w-screen-2xl p-4 sm:p-6 2xl:p-10">
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-sm2 font-bold text-black dark:text-white">ویرایش {{$moduleTitle}} </h2>
    </div>
    <div class="grid grid-cols-1 gap-9 mb-12">
        <div class="flex flex-col gap-9">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            <div class="flex flex-col gap-5.5 p-6.5">
            <x-base::admin.form submit="update">
                <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                    <x-base::admin.input name="title" title="عنوان" isLive="true"></x-base::admin.input>
                </div>

                <x-base::admin.select name="question_cat_id" title="دسته بندی پارامتر" :items="$questionCat" :value="$question_cats" ></x-base::admin.select>

                <x-base::admin.select name="type" title="نوع" :items="$typeItems" ></x-base::admin.select>

                <div x-data="{items: @entangle('items'),errors: @entangle('errors')}">
                    <template x-for="(item,index) in items" :key="index">
                        <div class="w-full sm:w-1/2" x-transition>
                            <label :for="'items-' + index" class="my-3 block" >پاسخ <span x-text="index + 1"></span></label>
                            <div class="flex">
                                <input type="text" :id="'items-' + index" x-model="items[index]" class="w-full rounded border border-stroke bg-gray px-4.5 py-3 font-medium text-black focus:border-primary focus-visible:outline-none dark:border-strokedark dark:bg-meta-4 dark:text-white dark:focus:border-primary" >
                                <button type="button" @click="items.splice(index, 1)" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-2 mb-5 mr-4 ml-2"  x-show="items.length > 0" >حذف</button>
                            </div>
                            @foreach ($items as $k=>$v )
                                <div x-show="index === {{ $k }}">
                                    @error("items.".$k)
                                    <div class="text-red-600">فیلد پاسخ <span x-text="index + 1"></span> اجباری است</div>
                                    @enderror
                                </div>
                            @endforeach
                        </div>
                    </template>
                    <button type="button" @click="items.push('')" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded ml-2 mb-5 mt-5">افزودن</button>
                </div>

                <x-base::admin.button title="ارسال" ></x-base::admin.button>
                </x-base::admin.form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

