<div wire:ignore>
    <div
        x-data="{ value: @entangle('value').defer }"
        x-init="$watch('value', function (value) {
            $refs.trix.editor.loadHTML(value)
            var length = $refs.trix.editor.getDocument().toString().length
            $refs.trix.editor.setSelectedRange(length - 1)
            })"
            wire:key="uniqueKey"
            wire:ignore
            >
    <label class="form-label">{{ __('Content') }} <span class="text-danger">*</span></label>
        <input  name="value" id="{{ $trixId }}" type="hidden" >
        <trix-editor input="{{ $trixId }}" x-ref="trix" class="trix-content"

        ></trix-editor>
    </div>

    <script>
        var trixEditor = document.getElementById("{{ $trixId }}")
        addEventListener("trix-blur", function(event) {
            @this.set('value', trixEditor.getAttribute('value'))
        })
    </script>

</div>
