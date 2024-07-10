<div>
    <x-jet-form-section submit="">
        <x-slot name="title">
            {{ __('Activies you share on Timebank.cc') }}
        </x-slot>

        <x-slot name="description">
            <p>{{ __('Which activities and skills can you share on Timebank? Give practical examples, avoid vague or general keywords.') }}
            <p> {{ __('Rare skills can be interesting for others, but very common activities are also very useful to offer!') }}
            </p>
        </x-slot>

        <x-slot name="form">
            <form wire:key="skills-form" wire:submit.prevent="save">

                <!-- Skills -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jet-label for="tags" value="{{ __('Activities or skills you offer to other Timebankers') }}"
                                 wire:loading.remove />
                    <x-jet-label for="tags" value="{{ __('Loading...') }}" wire:loading />
                    <div wire:ignore>

                        @php
                            $tagsJson = json_encode($tagsArray);
                            $suggestionsJson = json_encode($suggestions);
                        @endphp

                        <input :value="tagsJson" id="tags" placeholder="Select or create a new tag title"
                               type="text" wire:ignore x-data="{ input: @entangle('tagsArray'), tagsJson: {{ $tagsJson }}, suggestionsJson: {{ $suggestionsJson }} }" x-init="tagify = new Tagify($refs.input, {
                                   pattern: /^.{3,80}$/,
                                   maxTags: 40,
                                   autocapitalize: true,
                                   id: 'skillTags',
                                   whitelist: suggestionsJson,
                                   enforceWhiteList: false,
                                   backspace: false,
                                   editTags: false,
                                   dropdown: {
                                       maxItems: 10,
                                       classname: 'readonlyMix',
                                       enabled: 3,
                                       closeOnSelect: false,
                                       highlightFirst: true,
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
                               window.addEventListener('backdrop-click', onBackdropClick);"
                               x-ref="input">
                    </div>

                    <div class="my-6 grid grid-cols-1">
                        <x-errors />
                    </div>
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
                                        <div class="my-6 grid grid-cols-1 gap-6 pl-6 md:grid-cols-2"
                                             id='select-translation'>
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
                                                         wire:key="nameInput"
                                                         wire:model.lazy="inputTagTranslation.name" />
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
                                {{ __('Annuleren') }}
                            </x-jet-secondary-button>

                            <x-jet-secondary-button class="ml-3" wire:click="createTag()"
                                                    wire:loading.attr="disabled">
                                {{ __('Opslaan') }}
                            </x-jet-secondary-button>
                        </x-slot>
                    </x-jet-dialog-modal>
                </form>
        </x-slot>

        <x-slot name="actions">
            <x-jet-action-message class="mr-3" on="saved">
                {{ __('Saved') }}
            </x-jet-action-message>

            <x-jet-button wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save') }}
            </x-jet-button>
        </x-slot>

    </x-jet-form-section>

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
