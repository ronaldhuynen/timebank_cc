
<div>
    <form wire:submit.prevent="save">

        <!-- Skills -->
        <div class="">
            <x-jet-label for="tags" value="{{ __('Skills, separated by a comma') }}" />
        
            <div  wire:ignore >
                    <input 
                    wire:ignore
                        x-data="{ input: @entangle('tagsArray') }" 
                        x-ref="input" 
                        x-init=" tagify = new Tagify($refs.input, {
                            pattern: /^.{0,50}$/, // max 50 characters, make sure also vaidation rule in Model is equally set
                            maxTags: 40,
                            autocapitalize: true,
                            spellcheck: true,
                            whitelist: {{ json_encode($suggestions) }},
                            dropdown: {
                                {{-- position: 'text',    --}}
                                maxItems: 10, // <- mixumum allowed rendered suggestions
                                classname: 'readonlyMix',
                                enabled: 3, // show suggestions on focus
                                closeOnSelect: false // don't hide the dropdown when an item is selected
                            }
                        });
                        $refs.input.addEventListener('change', onChange)
                        
                        function onChange(e) {
                            $wire.set('tagsArray', e.target.value) // true sets defer to true
                        };"
                        
                        type="text"
                        placeholder='Select or create new tags' 
                        value="{{ $tagsArray }}">
            </div>
            @error('newTagsArray.*')
                <p class="col-span-6 mt-3 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="bg-gray-white flex items-center justify-end px-4 py-3 text-right">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved') }}
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:click="$emit('save')">
                {{ __('Save') }}
            </x-jet-button>
        </div>

    </form>
</div>
