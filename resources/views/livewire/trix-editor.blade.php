<div wire:ignore class="ml-auto mt-1 w-full">
    <div
        x-data="{ value: @entangle('value') }"
        x-init="
            document.addEventListener('trix-initialize', () => {
                if ($refs.trix && $refs.trix.editor) {
                    $refs.trix.editor.loadHTML(value || '');
                    var length = $refs.trix.editor.getDocument().toString().length;
                    $refs.trix.editor.setSelectedRange(length - 1);
                }

                $refs.trix.addEventListener('trix-change', event => {
                    value = event.target.value;
                });

                $watch('value', (value) => {
                    if ($refs.trix && $refs.trix.editor) {
                        $refs.trix.editor.loadHTML(value || '');
                        var length = $refs.trix.editor.getDocument().toString().length;
                        $refs.trix.editor.setSelectedRange(length - 1);
                    }
                });
            });
        "
        wire:key="{{ $trixId }}"
    >
        <input name="value" id="{{ $trixId }}" type="hidden" x-model="value"
            class="block w-full text-sm text-slate-500 rounded-lg border border-gray-400">
        <trix-editor input="{{ $trixId }}" x-ref="trix" class="trix-content"></trix-editor>
    </div>
</div>