<div wire:ignore>
<h1>Demo page: Ckeditor with Livewire</h1>
    <form wire:submit.prevent="submit">
                       <div
                    class="form-textarea w-full"
                    x-data
                    x-init="
                        ClassicEditor.create($refs.myIdentifierHere)
                        .then( function(editor){
                            editor.model.document.on('change:data', () => {
                               $dispatch('input', editor.getData())
                            })
                        })
                        .catch( error => {
                            console.error( error );
                        } );
                    "
                    wire:ignore
                    wire:key="myIdentifierHere"
                    x-ref="myIdentifierHere"
                    wire:model.debounce.9999999ms="demo.description"
                >{!! ($demo['description']) !!}</div>
            <button type="submit">Save</button>
    </form>

    <script>
        ClassicEditor
            .create(document.querySelector('#description'))
            .then(editor => {
                editor.setData('@this.demo,description');
                editor.model.document.on('change:data', (e) => {
                    @this.set('demo.description', editor.getData());
                })
            })
            .catch(error => {
                console.error(error);
            });
    </script>
</div>
