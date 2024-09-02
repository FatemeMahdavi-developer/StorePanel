<x-admin.form action="save" title="برند جدید">

<x-slot:content>

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
    <input wire:model='pic' type="file"  onchange="loadFile(event)" class="w-1/2 cursor-pointer rounded-lg border-[1.5px] border-stroke bg-transparent font-normal outline-none transition file:mr-5 file:border-collapse file:cursor-pointer file:border-0 file:border-r file:border-solid file:border-stroke file:bg-whiter file:px-5 file:py-3 file:hover:bg-primary file:hover:bg-opacity-10 focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:file:border-form-strokedark dark:file:bg-white/30 dark:file:text-white dark:focus:border-primary"/>
    @error("pic")<div class="text-red-600">{{$message}}</div>@enderror
    @if(!empty($path_pic))
    <img src="{{asset("files/".$path_pic)}}" class="mx-auto h-12 inline rounded">
    @endif
</div>
<div class="my-3">
    <label class="mb-3 block text-sm font-medium text-black dark:text-white">متن</label>
    <textarea wire:model='note' rows="6" class="w-full rounded-lg border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"></textarea>
    @error("note")<div class="text-red-600">{{$message}}</div>@enderror
</div>
{{-- <div class="my-3">
    <label class="mb-3 block text-sm font-medium text-black dark:text-white">دسته بندی</label>
    <select  wire:model="catids[]" multiple id="countries_multiple" class="w-1/2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
        <option>انتخاب کنید</option>
        @foreach ($product_cats as $product_cat)
            <option value="{{$product_cat["id"]}}">{{$product_cat["title"]}}</option>
        @endforeach
    </select>
</div> --}}
<div class="flex justify-end">
    <button type="submit" class="rounded-sm bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">ارسال</button>
</div>
{{-- <img id="output"/> --}}
{{-- <script>
    var output ='';
  var loadFile = function(event) {
    output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
        @this.set("{{$path_pic}}",  output.src);
      URL.revokeObjectURL(output.src)
    }
  };
</script> --}}

</x-slot>
</x-admin.form>
