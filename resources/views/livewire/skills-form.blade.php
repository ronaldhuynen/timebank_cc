<div>
    <form wire:submit.prevent="save">

        <!-- Skills -->
        <div class="">
            <x-jet-label for="tags" value="{{ __('Skills, separated by a comma') }}" />

            <div wire:ignore>
                <input wire:ignore x-data="{ input: @entangle('tagsArray') }" x-ref="input" x-init=" tagify = new Tagify($refs.input, {
                     pattern: /^.{0,50}$/, // max 50 characters, make sure also vaidation rule in Model is equally set
                     maxTags: 40,
                     autocapitalize: true,
                     id: 'skillTags',
                     whitelist: {{ json_encode($suggestions) }},
                     enforceWhiteList: true,
                     dropdown: {
                         {{-- position: 'text',    --}}
                         maxItems: 10, // <- maxumum allowed rendered suggestions
                         classname: 'readonlyMix', // Foreign tags are readonly and have a distict appearance
                         enabled: 3, // characters types to show suggestions on focus
                         closeOnSelect: false // don't hide the dropdown when an item is selected
                     }
                 });
                 $refs.input.addEventListener('change', onChange)
                
                 function onChange(e) {
                     $wire.set('tagsArray', e.target.value) // true sets defer to true
                 };" type="text"
                    placeholder='Select or create a new tag title' value="{{ $tagsArray }}">
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



        <!---- New Tag Modal ---->
        <form wire:submit.prevent="createtag">

            <x-jet-dialog-modal wire:model="modalVisible">
                <x-slot name="title">
                    {{ __('Add a new skill to Timebank.cc') }}
                </x-slot>

                <x-slot name="content">

                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <x-input label="Skill title *" placeholder="Accurate and unique title of this skill"
                            wire:model.defer="newTag.name" />
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <x-input label="Descriptive example *" placeholder="Give an example that illustrates this skill"
                            wire:model.defer="newTag.example" />
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <x-checkbox id="right-label" label="This example matches exactly the skill title *"
                            wire:model.defer="newTag.check" />
                    </div>

                    <div class="mt-2 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <x-select id="category" label="{{ __('Category') }}"
                            placeholder="{{ __('Select a category') }}" wire:model="newTagCategory"
                            class="placeholder-gray-300" :options="$categoryOptions" option-label="name"
                            option-value="category_id" />
                    </div>
                    @if (app()->getLocale() != 'en')
                        <div class="mt-6 grid grid-cols-1 gap-6">
                            <x-checkbox id="checkbox" label="{{ __('Attach an English translation to this skill') }}"
                                wire:model="translationVisible" />
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-6" wire:loading wire:target="translationVisible">
                            {{ __('Loading...') }}
                        </div>

                        <!-- Tag Translation --->
                        <div>
                            @if ($translationVisible)
                                <hr class="border-t border-gray-200" py-12 />
                                <x-radio id="radio-0" label="{{ __('Attach an existing skill in English') }}"
                                    wire:model="translateRadioButton" value="select" />
                                <div id='select-translation'
                                    class="my-6 grid grid-cols-1 gap-6 pl-6 md:grid-cols-2">
                                    <x-select id="translation" label=""
                                        placeholder="{{ __('Select a translation') }}" wire:model="selectTagTranslation"
                                        class="placeholder-gray-300" :options="$translationOptions" option-label="name"
                                        option-value="tag_id" />
                                    <div class="mt-6 grid grid-cols-1 gap-6" wire:loading wire:target="translationOptions">
                                        {{ __('Updating...') }}
                                    </div>
                                </div>
                                <hr class="border-t border-gray-200" py-12 />
                                <x-radio id="radio-1" label="{{ __('Create a new skill in English') }}"
                                    wire:model="translateRadioButton" value="input" />
                                    <div id="input-translation">
                                <div class="my-6 grid grid-cols-1 gap-6 pl-6">
                                    <x-input label="" placeholder="{{ $newTag['name'] }} {{ __('in English') }}"
                                        wire:model="inputTagTranslation.name" wire:key="nameInput" :disabled="$inputDisabled" />
                                </div>

                                <div class="mt-6 grid grid-cols-1 gap-6 pl-6">
                                    <x-input label="{{ __('Descriptive example in English') }}"
                                        placeholder="{{ __('Give an example in English that illustrates') }} {{ $newTag['name'] }}" disabled=false
                                        wire:model="inputTagTranslation.example" wire:key="exampleInput" :disabled="$inputDisabled" />
                                </div>
                                </div>
                            @endif
                        </div>
                        @endif

                </x-slot>


                <x-slot name="footer">
                    <x-jet-secondary-button wire:click="$toggle('modalVisible')" wire:loading.attr="disabled">
                        {{ __('Annuleren') }}
                    </x-jet-secondary-button>

                    <x-jet-secondary-button class="ml-3" wire:click="createTag()" wire:loading.attr="disabled">
                        {{ __('Opslaan') }}
                    </x-jet-secondary-button>
                </x-slot>
            </x-jet-dialog-modal>




        </form>
        <script>
            document.addEventListener('DOMContentLoaded', () => {

                window.livewire.on('disableSelect', () => {
                    document.getElementById('select-translation').style.opacity = '0.4';
                    document.getElementById('select-translation').style.cursor = 'pointer';
                    document.getElementById('select-translation').style.pointerEvents = 'none';              
                    document.getElementById('input-translation').style.opacity = '1';
                    console.log('disableSelect');
                });

                window.livewire.on('disableInput', () => {
                    document.getElementById('input-translation').style.opacity = '0.4';
                    document.getElementById('select-translation').style.cursor = 'default';
                    document.getElementById('select-translation').style.pointerEvents = 'auto';   
                    document.getElementById('select-translation').style.opacity = '1';
                    console.log('disableInput');

                });

            }); 
        </script>
</div>
