@props(['title'=>'','name'=>'','placeholder'=>'','value'=>'','class'=>'my-3'])
<div class="{{$class}}" wire:ignore>
    @if($title)
        <label class="mb-3 block text-sm font-medium text-black dark:text-white">{{$title}}</label>
    @endif

    <textarea wire:model.defer="{{$name}}" id="{{$name}}" rows="6" class="w-full rounded border-[1.5px] border-stroke bg-transparent px-5 py-3 font-normal text-black outline-none transition focus:border-primary active:border-primary disabled:cursor-default disabled:bg-whiter dark:border-form-strokedark dark:bg-form-input dark:text-white dark:focus:border-primary"> {{$value}}</textarea>

    {{-- Todo: --}}
    @error($name)<span class="text text-danger">{{$errors->first($name)}}</span>@enderror
</div>

<script>
    ClassicEditor.create(document.querySelector("#{{$name}}"), {
        language: {
            ui: 'fa',
            content: 'fa'
        },
        toolbar: ['heading','bold','italic','link','bulletedList','numberedList','blockQuote','codeBlock'],
    })
    .then(editor => {
        editorInstance = editor;
        editor.model.document.on('change:data', () => {
            clearTimeout(window.editorTimeout);
            window.editorTimeout = setTimeout(() => {
                @this.set("{{$name}}", editor.getData());
            },1000);
        });
    })
    .catch(error => {
        console.error(error);
    });
</script>
