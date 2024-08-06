<x-jetstream.form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Transfer Timebank Hours') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
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

                <x-jetstream.label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jetstream.secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jetstream.secondary-button>

                @if ($this->user->profile->profile_photo_path)
                    <x-jetstream.secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jetstream.secondary-button>
                @endif

                <x-jetstream.input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="name" value="{{ __('Name') }}" />
            <x-jetstream.input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" autocomplete="name" />
            <x-jetstream.input-error for="name" class="mt-2" />
        </div>

        <!-- Language -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="locale" value="{{ __('Language') }}" />
            <x-jetstream.input id="locale" type="text" class="mt-1 block w-full" wire:model="state.locale" autocomplete="locale" />
            <x-jetstream.input-error for="locale" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="email" value="{{ __('Email') }}" />
            <x-jetstream.input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" />
            <x-jetstream.input-error for="email" class="mt-2" />

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
        <x-jetstream.action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jetstream.action-message>

        <x-jetstream.button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jetstream.button>
    </x-slot>
</x-jetstream.form-section>