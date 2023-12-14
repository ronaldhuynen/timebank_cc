<x-jet-form-section submit="updateProfilePersonalForm">
    <x-slot name="title">
        {{ __('Personal') }}
            {{ info(config('timebank-cc.rules.profile_user.profile_photo')) }}

    </x-slot>

    <x-slot name="description">
        {{ __('Other users will recognize you by your name and photo. Your email address will be hidden for other users.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Profile Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-3 mb-3" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-3 mb-3" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Change Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto" x-on:click.prevent="">
                        {{ __('Delete Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- About Me -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea 
                wire:model.debounce.500ms="state.about" 
                label="{{ __('Please introduce yourself')}} *" 
                placeholder="{{ __('Short intro or background info') }}" 
                class="placeholder-gray-300"/>
            <x-jet-input-error for="about" class="mt-2" />
        </div>


        <!-- Motivation -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea 
                wire:model.debounce.500ms="state.motivation" 
                label="{{ __('Why are you Timbanker?') }} *" 
                placeholder="{{__('Just trying out or serious about a new value system?')}}" 
                class="placeholder-gray-300"/>
            <x-jet-input-error for="motivation" class="mt-2" />
        </div>

        <!--- Languages -->
        <div class="col-span-6 sm:col-span-4">
            @livewire('profile-user.languages-dropdown', ['languages' => $languages])
            <x-jet-input-error for="languages" class="mt-2" />
        </div>

        <!--- Social media -->
        <div class="col-span-6 sm:col-span-4">
            @livewire('socials-form')
            <x-jet-input-error for="socials" class="mt-2" />
        </div>


        <!-- Birth Date -->
        <div class="col-span-6 sm:col-span-4">
              <div class="col-span-2 sm:col-span-1">
                <!-- min age is 5 and max is 120 to prevent obvious faulty inputs / typo's -->
                <x-datetime-picker 
                    label="{{__('Date of birth') . ' ' . __('(DD-MM-YYYY)') }}"
                    without-time
                    without-tips
                    display-format="DD-MM-YYYY"
                    placeholder="{{__('Select a date')}}"
                    wire:model.defer="state.date_of_birth"
                    :max="now()->subYears(5)" 
                    :min="now()->subYears(120)"
                    class="placeholder-gray-300"
                />
                <x-jet-input-error for="date_of_birth" class="mt-2" />
            </div>
        </div>


        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="website" value="{{ __('My Website') }}" />
            <x-input
                placeholder="website.org"
                wire:model.lazy="website"
                class="placeholder-gray-300"
            />
        </div>
    </x-slot>

    <!-- List of validation errors -->
    <x-errors />

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

