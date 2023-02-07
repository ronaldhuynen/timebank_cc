<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('BIO') }}
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
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Delete Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- About Me -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model.defer="state.about" label="About me" placeholder="{{__('Short intro or background info')}}" />
            <x-jet-input-error for="about" class="mt-2" />
        </div>


        <!-- Motivation -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model.defer="state.motivation" label="{{ __('Why I am a Timbanker') }}" placeholder="{{__('Just trying out or serious about a new value system?')}}" />
            <x-jet-input-error for="motivation" class="mt-2" />
        </div>


        <!-- Birth Date -->
        <!-- FIXME: use proper localized date picker without if's-->
        @if (Illuminate\Support\Facades\App::isLocale('nl'))
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD-MM-YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @elseif(Illuminate\Support\Facades\App::isLocale('be'))
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD.MM.YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @elseif(Illuminate\Support\Facades\App::isLocale('de'))
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD.MM.YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @else
        {{-- Presume en is the locale --}}
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth') . ' ' . __('(day / month / year)') }}"
                without-time
                display-format="DD/MM/YYYY"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date')}}"
                wire:model.defer="state.date_of_birth"
            />
            <x-jet-input-error for="date_of_birth" class="mt-2" />
        </div>
        @endif

        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="state.website" value="{{ __('My Website') }}" />
            <x-input
                class="!pl-[3.8rem]"
                placeholder="your-website.org"
                prefix="https://"
                wire:model.defer="state.website"
            />
            <x-jet-input-error for="state.website" class="mt-2" />
        </div>


        </div>
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

