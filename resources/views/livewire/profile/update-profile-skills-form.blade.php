<div>
    <x-jetstream.form-section submit="">
        <x-slot name="title">
            {{ __('Activies you share on Timebank.cc') }}
        </x-slot>

        <x-slot name="description">
            <p>{{ __('Which activities and skills can you share on Timebank? Give practical examples, avoid vague or general keywords.') }}
            <p> {{ __('Rare skills can be interesting for others, but very common activities are also very useful to offer!') }}
            </p>
        </x-slot>

        <x-slot name="form">
            <form wire:key="skills-form" wire:submit="save">

                <!-- Skills -->
                <div class="col-span-6 sm:col-span-4">
                    <x-jetstream.label for="tags" value="{{ __('Activities or skills you offer to other Timebankers') }}"
                                 wire:loading.remove />
                    <x-jetstream.label for="tags" value="{{ __('Loading...') }}" wire:loading />
                    <div wire:ignore>

                        <input id="tags" placeholder="{{ __('Select or create a new tag title') }}" type="text"
                               value="{{ $tagsArray }}" x-data="{ input: @entangle('tagsArray').live }" x-init=" tagify = new Tagify($refs.input, {
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
                                tagify.on('dblclick', onChange)
                               
                                function onChange(e) {
                                    tagify.loading(true)
                                    $wire.set('tagsArray', e.target.value)
                                    {{-- console.log('onChange is fired') --}}
                                    tagify.loading(false)
                                };
                               
                                function onCancel(e) {
                                    tagify.removeTag(e.target.value)
                                };
                               
                                function onBackdropClick(e) {
                                    $wire.emit('cancelCreateTag')
                                }
                               
                                function onLoaded(e) {
                                    tagify.loading(true)
                               
                                    //document.querySelector('.tagify__input').focus()
                                    onChange(e)
                                    {{-- console.log('blur') --}}
                                    //document.querySelector('.tagify__input').blur()
                                    tagify.loading(false)
                                };
                               
                                $refs.input.addEventListener('change', onChange)
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
                <form wire:submit="createtag">

                    <x-jetstream.dialog-modal wire:model.live="modalVisible">
                        <x-slot name="title">
                            {{ __('Add a new activity or skill to Timebank.cc') }}
                        </x-slot>

                        <x-slot name="content">

                            <div class="mt-6 grid grid-cols-1 gap-6">
                                <x-jetstream.input label="{{ __('Activity tag name') }} *"
                                         placeholder="{{ __('Accurate and unique name for this activity, avoid vague or general keywords') }}"
                                         wire:model.blur="newTag.name" />
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-6">
                                <x-jetstream.input label="{{ __('Descriptive example') }} *"
                                         placeholder="{{ __('Give a practical example that clearly illustrates this activity') }}"
                                         wire:model.blur="newTag.example" />
                            </div>
                            <div class="mt-6 grid grid-cols-1 gap-6">
                                <x-jetstream.checkbox id="right-label"
                                            label="{{ __('This example matches exactly the Activity tag') }} *"
                                            wire:model.live="newTag.check" />
                            </div>

                            <div class="mt-2 grid grid-cols-1 gap-6 md:grid-cols-2">
                                <x-select :options="$categoryOptions" class="placeholder-gray-300" id="category"
                                          label="{{ __('Category') }}" option-label="name" option-value="category_id"
                                          placeholder="{{ __('Select a category') }}" wire:model.live="newTagCategory" />
                            </div>
                            @if (app()->getLocale() != config('timebank-cc.base_language'))
                                <div class="mt-6 grid grid-cols-1 gap-6">
                                    <x-jetstream.checkbox id="checkbox"
                                                label="{{ __('Attach an ' . config('timebank-cc.base_language_name') . ' translation to this tag') }}"
                                                wire:model.live="translationVisible" />
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
                                                {{ info($newTag['name'] ?? 'newTag is null')}}
                                                <x-jetstream.input :disabled="$inputDisabled"
                                                         {{-- placeholder="'{{ $newTag['name'] . '\' ' . __('in') . ' ' . config('timebank-cc.base_language_name') ?? __('Activity tag name in') . ' ' . config('timebank-cc.base_language_name') }}" --}}
                                                         wire:key="nameInput"
                                                         wire:model.blur="inputTagTranslation.name" />
                                            </div>

                                            <div class="mt-6 grid grid-cols-1 gap-6 pl-6">
                                                <x-jetstream.input :disabled="$inputDisabled" label=""
                                                         label="{{ __('Descriptive example in English') }}"
                                                         placeholder="{{ __('Give a practical example that clearly illustrates') }} {{ $inputTagTranslation['name'] ?? __('this activity') }} "
                                                         wire:key="translationExample"
                                                         wire:model.blur="inputTagTranslation.example" />
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
                            <x-jetstream.secondary-button wire:click="cancelCreateTag()" wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-jetstream.secondary-button>

                            <x-jetstream.secondary-button class="ml-3" wire:click="createTag()" wire:loading.attr="disabled">
                                {{ __('Save') }}
                            </x-jetstream.secondary-button>
                        </x-slot>
                    </x-jetstream.dialog-modal>
                </form>
        </x-slot>

        <x-slot name="actions">
                <x-jetstream.action-message class="mr-3" on="saved">
                    {{ __('Saved') }}
                </x-jetstream.action-message>
                <x-jetstream.button wire:loading.attr="disabled" wire:click="$dispatch('save')">
                    {{ __('Save') }}
                </x-jetstream.button>
        </x-slot>

    </x-jetstream.form-section>

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

