<x-jetstream.form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Professional') }}
    </x-slot>

    <x-slot name="description">
        {{ __('What professional experience do you have?') }}
    </x-slot>

    <x-slot name="form">

         <!-- About Me -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model="state.about" label="About me" placeholder="{{__('Short intro or background info')}}" />
            <x-jetstream.input-error for="about" class="mt-2" />
        </div>


        <!-- Motivation -->
        <div class="col-span-6 sm:col-span-4">
            <x-textarea wire:model="state.motivation" label="{{ __('Why I am a Timbanker') }}" placeholder="{{__('Just trying out or serious about a new value system?')}}" />
            <x-jetstream.input-error for="motivation" class="mt-2" />
        </div>


        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jetstream.label for="state.website" value="{{ __('Website') }}" />
            <x-jetstream.input
                class="!pl-[3.8rem]"
                placeholder="website.org"
                prefix="https://"
                wire:model="state.website"
            />
            <x-jetstream.input-error for="state.website" class="mt-2" />
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

