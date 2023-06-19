<div wire:ignore>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css" />
    <input id="{{ $trixId }}" type="hidden" name="content" value="{{ $value }}">
    <trix-editor wire:model.debounce.2000ms="value" input="{{ $trixId }}"></trix-editor>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>


<script>
    var trixEditor = document.getElementById("{{ $trixId }}")

    addEventListener("trix-blur", function(event) {
        @this.set('value', trixEditor.getAttribute('value'))
    })
</script>

</div>
