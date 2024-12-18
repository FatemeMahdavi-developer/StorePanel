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
                <x-base::admin.input name="title" title="عنوان" ></x-base::admin.input>
            </div>

            <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                <x-base::admin.input name="seo_url" title="آدرس سئو" ></x-base::admin.input>
                <x-base::admin.input name="seo_title" title="عنوان سئو" ></x-base::admin.input>
            </div>

            <div class="mb-5.5 flex flex-col gap-5.5 sm:flex-row">
                <x-base::admin.upload_file name="image" title="تصویر" :updatingValue="$pathImage" :value="$image" >
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
              <x-base::admin.select_recursive name="parent_id" first_option="دسته بندی اصلی" title="دسته بندی" :options="$productCats" :value="$parent_id" ></x-base::admin.select_recursive>
              <x-base::admin.select2_multiple name="product_brands_selected" placeholder="انتخاب کنید" title="برند" :value="$product_brands_selected" :items="$product_brands" ></x-base::admin.select2_multiple>
            </div>
            <x-base::admin.ckeditor name="note" title="توضیحات" value="{{$note}}"></x-base::admin.ckeditor>
            <x-base::admin.button title="ارسال"></x-base::admin.button>
            </x-base::admin.form>
            </div>
        </div>
        </div>
        </div>
    </div>
</div>

{{-- <script>
    function dropdown() {
      return {
        options: [],
        selected: @json($product_brands_selected),
        show: false,
        open() {
          this.show = true;
        },
        close() {
          this.show = false;
        },
        isOpen() {
          return this.show === true;
        },
        select(index, event) {
          if (!this.options[index].selected) {
            this.options[index].selected = true;
            this.options[index].element = event.target;
            this.selected.push(index);
          } else {
            this.selected.splice(this.selected.lastIndexOf(index), 1);
            this.options[index].selected = false;
          }
          @this.set('product_brands_selected', this.selectedValues());
        },
        remove(index, option) {
        if (this.options[option]) {
        this.options[option].selected = false;
        this.selected.splice(index, 1);
        }
          @this.set('product_brands_selected', this.selectedValues());
        },
        loadOptions() {
          const options = document.getElementById("select").options;
          for (let i = 0; i < options.length; i++) {
            this.options.push({
              value: options[i].value,
              text: options[i].innerText,
              selected:
                options[i].getAttribute("selected") != null
                  ? options[i].getAttribute("selected")
                  : false,
            });
          }
        },
        selectedValues() {
          return this.selected.map((option) => {
            return this.options[option].value;
          });
        },
      };
    }
  </script> --}}
