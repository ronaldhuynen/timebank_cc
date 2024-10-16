<div>
    <form wire:key="skills-form" wire:submit="save">

        <!-- Skills -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="tags" value="{{ __('Activities or skills you offer to other Timebankers') }}"
                               wire:loading.remove />
            <x-jetstream.label for="tags" value="{{ __('Loading...') }}" wire:loading />
            <div wire:ignore>
                <input id="tags" placeholder="{{ __('Select or create a new tag title') }}"
                       type="text" value="{{ $tagsArray }}" x-data="{ input: @entangle('tagsArray').live }" x-ref="input" data-suggestions='@json($suggestions)'>
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

        <script src="{{ asset('js/skilltags.js') }}"></script>
</div>