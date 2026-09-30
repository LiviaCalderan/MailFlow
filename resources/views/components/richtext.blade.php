<script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">

@props([
    'label' => null,
    'value' => '',
    'placeholder' => '',
    'name' => null,
    'id' => $name ?? 'richtext',
])

<div x-data="{
        value: @js($value),
        quill: null,

        init() {
            this.quill = new Quill(this.$refs.editor, {
                theme: 'snow',
                placeholder: @js($placeholder),

                modules: {
                    toolbar: [
                        [{ header: [1, 2, 3, false] }],
                        ['bold', 'italic', 'underline', 'strike'],
                        [{ list: 'ordered' }, { list: 'bullet' }],
                        [{ align: [] }],
                        ['link'],
                        ['clean']
                    ]
                }
            });

            
            this.quill.root.innerHTML = this.value || '';

            
            this.quill.on('text-change', () => {
                this.value = this.quill.root.innerHTML;
            });

            
            this.$watch('value', (value) => {
                if (value !== this.quill.root.innerHTML) {
                    this.quill.root.innerHTML = value || '';
                }
            });
        }
    }" x-modelable="value" {{ $attributes->whereStartsWith('wire:') }}>
    @if($label)
        <label for="{{ $id }}" class="mb-1 block text-sm font-medium text-gray-700 dark:text-gray-300 dark:font-bold">
            {{ $label }}
        </label>
    @endif

    <div wire:ignore class="disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm bg-white dark:bg-white/10 text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500 shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5 data-invalid:shadow-none data-invalid:border-red-500 dark:data-invalid:border-red-500 disabled:data-invalid:border-red-500 dark:disabled:data-invalid:border-red-500">
        <div x-ref="editor" id="{{ $id }}" class="min-h-50 "></div>
    </div>

    <input type="hidden" name="{{ $name }}" x-model="value" class="bg-zinc-950">
</div>