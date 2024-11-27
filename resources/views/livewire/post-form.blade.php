<div>
    <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="title">
            Post title
        </label>
        <input wire:model="title" id="title" type="text" class="mt-2 w-full rounded-lg border border-gray-400 py-2 pr-4 pl-2 text-sm focus:border-blue-400 focus:outline-none sm:text-base" required />
        @error('title')
            <div class="mt-1 text-sm text-red-500">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="body">
            Body
        </label>
        <div wire:ignore>
            <div x-data
                 x-ref="editor"
                 x-init="
                    const quill = new Quill($refs.editor, {
                        theme: 'snow'
                    });
                    quill.on('text-change', () => {
                        $wire.set('body', quill.root.innerHTML)
                    })
                 ">{!! $body !!}
            </div>
        </div>
        @error('body')
            <div class="mt-1 text-sm text-red-500">
                {{ $message }}
            </div>
        @enderror
    </div>

    <div class="mt-4 flex items-center">
        <button wire:click="submitForm" type="submit"
                class="inline-flex items-center rounded-md border border-transparent bg-gray-800 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:shadow-outline-gray focus:border-gray-900 focus:outline-none active:bg-gray-900 disabled:opacity-25">
            Save Post
        </button>
    </div>
</div>
