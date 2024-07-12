<div>
    <form wire:key="skills-form" wire:submit.prevent="save">

        <!-- Skills -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="tags" value="{{ __('Activities or skills you offer to other Timebankers') }}"
                         wire:loading.remove />
            <x-jet-label for="tags" value="{{ __('Loading...') }}" wire:loading />
            <div wire:ignore>

                <input id="tags" placeholder="{{ __('Select or create a new tag title') }}" type="text"
                       value="{{ $tagsArray }}" x-data="{ input: @entangle('tagsArray') }" x-init=" tagify = new Tagify($refs.input, {
                            pattern: /^.{3,80}$/, // max 80 characters, make sure also vaidation rule in Model is equally set
                            maxTags: 40,
                            autocapitalize: true,
                            id: 'skillTags',
                            whitelist: {{ json_encode($suggestions) }},
                            enforceWhiteList: false,
                            backspace: false,
                            editTags: false,
                            dropdown: {
                                maxItems: 10, // <- maximum allowed rendered suggestions
                                classname: 'readonlyMix', // Foreign tags are readonly and have a distict appearance
                                enabled: 3, // characters types to show suggestions on focus
                                closeOnSelect: false, // don't hide the dropdown when an item is selected
                                highlightFirst: true, // hightlight / suggest best match
                            },
                        });
                        tagify.on('dblclick', onChange);
                       
                        function onChange(e) {
                            tagify.loading(true);
                            $wire.set('tagsArray', e.target.value);
                            tagify.loading(false);
                        };
                       
                        function onCancel(e) {
                            tagify.removeTag(e.target.value);
                        };
                       
                        function onBackdropClick(e) {
                            $wire.emit('cancelCreateTag');
                        }
                       
                        function onLoaded(e) {
                            tagify.loading(true);
                            onChange(e);
                            tagify.loading(false);
                        };
                       
                        $refs.input.addEventListener('change', onChange);
                        window.addEventListener('load', onLoaded);
                        window.addEventListener('cancelCreateTag', onCancel);
                        window.addEventListener('backdrop-click', onBackdropClick);" x-ref="input">

            </div>

            <div class="my-6 grid grid-cols-1">
                <x-errors />
            </div>
        </div>

        <div class="bg-gray-white flex items-center justify-end px-0 py-3 text-right">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved') }}
            </x-jet-action-message>
            <x-jet-button wire:click="$emit('save')" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-jet-button>
        </div>

        <!---- New Tag Modal ---->
        <form wire:submit.prevent="createtag">

            <x-jet-dialog-modal wire:model="modalVisible">
                <x-slot name="title">
                    {{ __('Add a new activity or skill to Timebank.cc') }}
                </x-slot>

                <x-slot name="content">

                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <x-input label="{{ __('Activity tag name') }} *"
                                 placeholder="{{ __('Accurate and unique name for this activity, avoid vague or general keywords') }}"
                                 wire:model.lazy="newTag.name" />
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <x-input label="{{ __('Descriptive example') }} *"
                                 placeholder="{{ __('Give a practical example that clearly illustrates this activity') }}"
                                 wire:model.lazy="newTag.example" />
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-6">
                        <x-checkbox id="right-label"
                                    label="{{ __('This example matches exactly the Activity tag') }} *"
                                    wire:model="newTag.check" />
                    </div>

                    <div class="mt-2 grid grid-cols-1 gap-6 md:grid-cols-2">
                        <x-select :options="$categoryOptions" class="placeholder-gray-300" id="category"
                                  label="{{ __('Category') }}" option-label="name" option-value="category_id"
                                  placeholder="{{ __('Select a category') }}" wire:model="newTagCategory" />
                    </div>
                    @if (app()->getLocale() != config('timebank-cc.base_language'))
                        <div class="mt-6 grid grid-cols-1 gap-6">
                            <x-checkbox id="checkbox"
                                        label="{{ __('Attach an ' . config('timebank-cc.base_language_name') . ' translation to this tag') }}"
                                        wire:model="translationVisible" />
                        </div>

                        <div class="mt-6 grid grid-cols-1 gap-6" wire:loading wire:target="translationVisible">
                            {{ __('Loading...') }}
                        </div>

                        <!-- Tag Translation --->
                        <div>
                            @if ($translationVisible)
                                <hr class="border-t border-gray-200" py-12 />
                                <x-radio id="radio-0"
                                         label="{{ __('Select an existing Activity tag in ' . config('timebank-cc.base_language_name')) }}"
                                         value="select" wire:model="translateRadioButton" />
                                <div class="my-6 grid grid-cols-1 gap-6 pl-6 md:grid-cols-2" id='select-translation'>
                                    <x-select :options="$translationOptions" class="placeholder-gray-300" id="translation"
                                              label="" option-label="name" option-value="tag_id"
                                              placeholder="{{ __('Select a translation') }}"
                                              wire:model="selectTagTranslation" />
                                    <div class="mt-6 grid grid-cols-1 gap-6" wire:loading
                                         wire:target="translationOptions">
                                        {{ __('Updating...') }}
                                    </div>
                                </div>
                                <hr class="border-t border-gray-200" py-12 />
                                <x-radio id="radio-1"
                                         label="{{ __('Or create a new Activity tag in ' . config('timebank-cc.base_language_name')) }}"
                                         value="input" wire:model="translateRadioButton" />
                                <div id="input-translation">
                                    <div class="my-6 grid grid-cols-1 gap-6 pl-6">
                                        <x-input :disabled="$inputDisabled"
                                                 placeholder="'{{ $newTag['name'] . '\' ' . __('in') . ' ' . config('timebank-cc.base_language_name') ?? __('Activity tag name in') . ' ' . config('timebank-cc.base_language_name') }}"
                                                 wire:key="nameInput" wire:model.lazy="inputTagTranslation.name" />
                                    </div>

                                    <div class="mt-6 grid grid-cols-1 gap-6 pl-6">
                                        <x-input :disabled="$inputDisabled" label=""
                                                 label="{{ __('Descriptive example in English') }}"
                                                 placeholder="{{ __('Give a practical example that clearly illustrates') }} {{ $inputTagTranslation['name'] ?? __('this activity') }} "
                                                 wire:key="translationExample"
                                                 wire:model.lazy="inputTagTranslation.example" />
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
                    <x-jet-secondary-button wire:click="cancelCreateTag()" wire:loading.attr="disabled">
                        {{ __('Cancel') }}
                    </x-jet-secondary-button>

                    <x-jet-secondary-button class="ml-3" wire:click="createTag()" wire:loading.attr="disabled">
                        {{ __('Save') }}
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
                    {{-- console.log('disableSelect'); --}}
                });
                window.livewire.on('disableInput', () => {
                    document.getElementById('input-translation').style.opacity = '0.4';
                    document.getElementById('select-translation').style.cursor = 'default';
                    document.getElementById('select-translation').style.pointerEvents = 'auto';
                    document.getElementById('select-translation').style.opacity = '1';
                    {{-- console.log('disableInput'); --}}
                });
                window.addEventListener('tagifyChange', function(e) {
                    tagify.loading(true)
                    tagify.loadOriginalValues(e.detail.tagsArray)
                    tagify.loading(false)
                });
            });
        </script>

</div>
