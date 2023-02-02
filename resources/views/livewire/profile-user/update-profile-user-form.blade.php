<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('BIO') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Other users will recognize you by your name and photo. Your email address will be hidden for other users.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Avator photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
        <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
            <!-- Photo File Input -->
            <input type="file" class="hidden" wix re:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

            <x-jet-label for="photo" value="{{ __('Profile Photo') }}" />

            <!-- Current Photo -->
            <div class="mt-3 mb-3" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
            </div>

            <!-- New Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center" x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
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
            {{-- <x-jet-label for="name" value="{{ __('About Me') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" /> --}}
            <x-textarea wire:model.defer="about-me" label="About me" placeholder="{{__('Short intro or background info.')}}" />
            <x-jet-input-error for="about-me" class="mt-2" />
        </div>



        <!-- Motivation -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model.defer="motivation" label="{{ __('Why I am a Timbanker') }}" placeholder="{{__('Explain why you are on Timebank.cc.')}}" />
            <x-jet-input-error for="motivation" class="mt-2" />
        </div>



        <!-- Birth Date -->
        <div class="col-span-4 sm:col-span-3">
            <x-datetime-picker
                label="{{__('Date of Birth')}}"
                without-time
                display-format="LL"
                :min="now()->subYears(100)"
                :max="now()->subYears(10)"
                placeholder="{{__('Select a date.')}}"
                wire:model.defer="birthdate"
            />
            <x-jet-input-error for="birthday" class="mt-2" />
        </div>


        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="website" value="{{ __('My Website') }}" />
            <x-input
                class="!pl-[3.8rem]"
                placeholder="your-website.com"
                prefix="https://"
                wire:model.defer="website"
            />
            <x-jet-input-error for="website" class="mt-2" />
        </div>




            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}
                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

