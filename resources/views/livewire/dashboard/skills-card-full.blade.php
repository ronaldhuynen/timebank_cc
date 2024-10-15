<div>
    <form wire:key="skills-form" wire:submit="save">

        <!-- Skills -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="tags" value="{{ __('Activities or skills you offer to other Timebankers') }}"
                               wire:loading.remove />
            <x-jetstream.label for="tags" value="{{ __('Loading...') }}" wire:loading />
            <div wire:ignore><input id="tags" placeholder="{{ __('Select or create a new tag title') }}"
                       type="text" value="{{ $tagsArray }}" x-data="{ input: @entangle('tagsArray').live }" x-ref="input">

                <script>
                    let tagify;

                    document.addEventListener('DOMContentLoaded', function() {
                        initializeTagify();
                    });

                    function initializeTagify() {
                        const input = document.getElementById('tags');
                        const tagify = new Tagify(input, {
                            pattern: /^.{3,80}$/, // max 80 characters, make sure also validation rule in Model is equally set
                            maxTags: 40,
                            autocapitalize: true,
                            id: 'skillTags',
                            whitelist: @json($suggestions),
                            enforceWhiteList: false,
                            backspace: false,
                            editTags: false,
                            dropdown: {
                                classname: 'bg-black text-white',
                                maxItems: 10, // maximum allowed rendered suggestions
                                classname: 'readonlyMix', // Foreign tags are readonly and have a distinct appearance
                                enabled: 3, // characters typed to show suggestions on focus
                                position: 'text', // place the dropdown near the typed text
                                closeOnSelect: true, // don't hide the dropdown when an item is selected
                                highlightFirst: false, // highlight / suggest best match
                            },
                        });

                        tagify.on('dblclick', onChange);

                        function onChange(e) {
                            const component = Livewire.find(input.closest('[wire\\:id]').getAttribute('wire:id'));
                            component.set('tagsArray', e.target.value);
                            console.log('onChange is executed')
                        }

                        function onRemove(e) {
                            onChange(e);
                            // Listen for Livewire updates to modalVisible
                            setTimeout(() => {
                                // Your logic to remove the tag
                                console.log('Removing tag after delay');
                                // Example: Remove the first tag
                                tagify.removeTag(e.target.value);
                            }, 1000); // 1 second delay
                        }

                        function onLoaded(e) {
                            onChange(e);
                        }

                        input.addEventListener('change', onChange);
                        window.addEventListener('load', onLoaded);
                        window.addEventListener('remove', onRemove);
                    }

                    // Listen for Livewire event
                    Livewire.on('reinitializeTagify', () => {
                        initializeTagify();
                    });
                </script>
            </div>

            <div class="my-6 grid grid-cols-1">
                <x-errors />
            </div>
        </div>

        <div class="bg-gray-white flex items-center justify-end px-0 py-3 text-right">
            <x-jetstream.action-message class="mr-3" on="saved">
                {{ __('Saved') }}
            </x-jetstream.action-message>
            <x-jetstream.button wire:click="$dispatch('save')" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jetstream.button>
        </div>

        <!---- New Tag Modal ---->
        @if ($newTag)
            <form wire:submit.prevent="createTag">

                <x-jetstream.dialog-modal wire:model.live="modalVisible">
                    <x-slot name="title">
                        {{ __('Add a new activity or skill to Timebank.cc') }}
                    </x-slot>

                    <x-slot name="content">

                        <div class="mt-6 grid grid-cols-1 gap-6">
                            <x-input label="{{ __('Activity tag (min. 2 words)') }} *"
                                     placeholder="{{ __('Accurate and unique name for this activity, avoid vague or general keywords') }}"
                                     wire:model.defer="newTag.name" />
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-6">
                            <x-input label="{{ __('Descriptive example') }} *"
                                     placeholder="{{ __('Give a practical example that clearly illustrates this activity') }}"
                                     wire:model.defer="newTag.example" />
                        </div>
                        <div class="mt-6 grid grid-cols-1 gap-6">
                            <x-checkbox id="right-label"
                                        label="{{ __('This example matches exactly the activity tag') }} *"
                                        wire:model.live="newTag.check" />
                        </div>

                        <div class="mt-2 grid grid-cols-1 gap-6 md:grid-cols-2">
                            <x-select :options="$categoryOptions" class="placeholder-gray-300" id="category"
                                      label="{{ __('Category') }}" option-label="name" option-value="category_id"
                                      placeholder="{{ __('Select a category') }}" wire:model="newTagCategory" />
                        </div>
                        @php
                            $baseLanguage = config('timebank-cc.base_language_name');
                            $article = $baseLanguage === 'English' ? 'an' : 'a';
                        @endphp
                        @if (app()->getLocale() != config('timebank-cc.base_language'))
                            <div class="mt-6 grid grid-cols-1 gap-6">
                                <x-checkbox id="checkbox"
                                            label="{{ __('Attach ' . $article . ' ' . $baseLanguage . ' translation to this tag (recommended)') }}"
                                            wire:model.live="translationVisible" />
                            </div>

                            <div class="mt-6 grid grid-cols-1 gap-6" wire:loading wire:target="translationVisible">
                                <x-mini-button flat icon="" primary rounded spinner /> <span>
                                    {{ __('Loading...') }}
                                </span>
                            </div>

                            <!-- Tag Translation --->
                            <div>
                                @if ($translationVisible)
                                    <hr class="border-t border-gray-200" py-12 />
                                    <x-radio id="radio-0"
                                             label="{{ __('Select an existing Activity tag in ' . config('timebank-cc.base_language_name')) }}"
                                             value="select" wire:model.live="translateRadioButton" />
                                    <div class="my-6 grid grid-cols-1 gap-6 pl-6 md:grid-cols-2"
                                         id='select-translation'>
                                        <x-select :options="$translationOptions" class="placeholder-gray-300" id="translation"
                                                  label="" option-label="name" option-value="tag_id"
                                                  placeholder="{{ __('Select a translation') }}"
                                                  wire:model.live="selectTagTranslation" />
                                        <div class="mt-6 grid grid-cols-1 gap-6" wire:loading
                                             wire:target="translationOptions">
                                            {{ __('Updating...') }}
                                        </div>
                                    </div>
                                    <hr class="border-t border-gray-200" py-12 />
                                    <x-radio id="radio-1"
                                             label="{{ __('Or create a new Activity tag in ' . config('timebank-cc.base_language_name')) }}"
                                             value="input" wire:model.live="translateRadioButton" />
                                    <div id="input-translation">
                                        <div class="my-6 grid grid-cols-1 gap-6 pl-6">
                                            <x-jetstream.input :disabled="$inputDisabled"
                                                               placeholder="'{{ $newTag['name'] . '\' ' . __('in') . ' ' . config('timebank-cc.base_language_name') ?? __('Activity tag name in') . ' ' . config('timebank-cc.base_language_name') }}"
                                                               wire:key="nameInput"
                                                               wire:model.defer="inputTagTranslation.name" />
                                        </div>

                                        <div class="mt-6 grid grid-cols-1 gap-6 pl-6">
                                            <x-jetstream.input :disabled="$inputDisabled" label=""
                                                               label="{{ __('Descriptive example in English') }}"
                                                               placeholder="{{ __('Give a practical example that clearly illustrates') }} {{ $inputTagTranslation['name'] ?? __('this activity') }} "
                                                               wire:key="translationExample"
                                                               wire:model.defer="inputTagTranslation.example" />
                                        </div>
                                    </div>
                                @endif
                            </div>
                        @endif
                        <div class="my-6 grid grid-cols-1">
                            <x-errors />
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jetstream.secondary-button wire:click="cancelCreateTag" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jetstream.secondary-button>

                        <x-jetstream.secondary-button class="ml-3" wire:click="createTag"
                                                      wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jetstream.secondary-button>
                    </x-slot>
                </x-jetstream.dialog-modal>
            </form>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                Livewire.on('reinitializeTagify', () => {
                    initializeTagify();
                });
             
                window.Livewire.on('disableSelect', () => {
                    document.getElementById('select-translation').style.opacity = '0.4';
                    document.getElementById('select-translation').style.cursor = 'pointer';
                    document.getElementById('select-translation').style.pointerEvents = 'none';
                    document.getElementById('input-translation').style.opacity = '1';
                });
                window.Livewire.on('disableInput', () => {
                    document.getElementById('input-translation').style.opacity = '0.4';
                    document.getElementById('select-translation').style.cursor = 'default';
                    document.getElementById('select-translation').style.pointerEvents = 'auto';
                    document.getElementById('select-translation').style.opacity = '1';
                });
            });
        </script>

</div>
