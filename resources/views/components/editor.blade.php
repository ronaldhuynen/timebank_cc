<div wire:ignore>
  <textarea
    class="ck-content"
    id="{{ $attributes['id'] }}"
    wire:model.debounce.2000ms="{{ $attributes['property'] }}">
  </textarea>



<script>

  window.addEventListener('openModal', event => {
    let editor;

        ClassicEditor.create(document.getElementById(`{{ $attributes['id']}}`), {
        })
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => {});
        document.querySelector('button[type="submit"]').addEventListener('click', function () {
          @this.set('{{ $attributes['property'] }}', editor.getData());
      });
  });


  window.addEventListener('closeModal', event => {
    document.querySelector('.ck-editor__editable').ckeditorInstance.destroy()
  });

</script>

</div>
