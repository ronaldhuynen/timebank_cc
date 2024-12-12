<div>

    <div class="mb-4">
         <div wire:ignore>
            <div x-data x-init="const quill = new Quill($refs.editor, {
                modules: {
                    toolbar: [
                        [{ header: [1, 2, false] }],
                        ['bold', 'italic', 'underline', 'strike', 'link'],
                        [{'list': 'bullet' }],
                        [{ 'align': [] }],
                        ['link', 'image', 'video'],
                        ['clean']  
                    ],
                },
                theme: 'snow',
            });
            quill.on('text-change', () => {
                $wire.set('content', quill.root.innerHTML)
            })" x-ref="editor">{!! $content !!}
            </div>
        </div>
        @error('body')
            <div class="mt-1 text-sm text-red-500">
                {{ $message }}
            </div>
        @enderror
    </div>

</div>
