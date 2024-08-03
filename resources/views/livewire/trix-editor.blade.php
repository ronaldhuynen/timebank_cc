<div wire:ignore class="ml-auto mt-6 w-full">
    <div
        x-data="{ value: @entangle('value') }"
        x-init="$watch('value', function (value) {
            $refs.trix.editor.loadHTML(value)
            var length = $refs.trix.editor.getDocument().toString().length
            $refs.trix.editor.setSelectedRange(length - 1)
            })"
            wire:key="uniqueKey"
            wire:ignore
            >
    <label class="form-label">{{ __('Content') }}</label>
        <input  name="value" id="{{ $trixId }}" type="hidden"
        class="block w-full text-sm text-slate-500 rounded-lg border border-gray-400">
        <trix-editor input="{{ $trixId }}" x-ref="trix" class="trix-content"

        ></trix-editor>
    </div>

</div>
