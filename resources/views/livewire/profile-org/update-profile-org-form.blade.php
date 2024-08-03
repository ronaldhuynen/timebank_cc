<x-jetstream.form-section submit="updateProfilePersonalForm">
    <x-slot name="title">
        {{ __('Organization info') }}

    </x-slot>

    <x-slot name="description">
        {{ __('Other users will recognize your organization by your name and photo.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model.live="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jetstream.label for="photo" value="{{ __('Profile Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-3 mb-3" x-show="! photoPreview">
                    <img src="{{ $this->organization->profile_photo_url }}" alt="{{ $this->organization->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-3 mb-3" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jetstream.secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Change Photo') }}
                </x-jetstream.secondary-button>

                @if ($this->organization->profile_photo_path)
                    <x-jetstream.secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto" x-on:click.prevent="">
                        {{ __('Delete Photo') }}
                    </x-jetstream.secondary-button>
                @endif

                <x-jetstream.input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Description -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea 
                wire:model.live.debounce.800ms="state.about" 
                label="{{ __('Please introduce your organization')}} *" 
                placeholder="{{ __('What does your organization do? And why?') }}" 
                class="placeholder-gray-300"/>
            <x-jetstream.input-error for="about" class="mt-2" />
        </div>

        <!-- Very short intro -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea 
                wire:model.live.debounce.500ms="state.about_short" 
                label="{{ __('Introduction in one sentence')}} *" 
                placeholder="{{ __('I.e. your goal or slogan') }}" 
                class="placeholder-gray-300"/>
            <x-jetstream.input-error for="about" class="mt-2" />
        </div>

        <!-- Motivation -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea 
                wire:model.live.debounce.800ms="state.motivation" 
                label="{{ __('Why is your organization using Timebank?') }} *" 
                placeholder="{{__('Reaching out to a new community or serious about a new value system?')}}" 
                class="placeholder-gray-300"/>
            <x-jetstream.input-error for="motivation" class="mt-2" />
        </div>

        <!--- Languages -->
        <div class="col-span-6 sm:col-span-4">
            @livewire('profile-org.languages-dropdown', ['languages' => $languages])
            <x-jetstream.input-error for="languages" class="mt-2" />
        </div>

        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="website" value="{{ __('Organization Website') }}" />
            <x-jetstream.input
                placeholder="website.org"
                wire:model.blur="website"
                class="placeholder-gray-300"
            />
        </div>

    </x-slot>

    <!-- List of validation errors -->
    <x-errors />

    <x-slot name="actions">
        <x-jetstream.action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jetstream.action-message>

        <x-jetstream.button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jetstream.button>
    </x-slot>
</x-jetstream.form-section>

