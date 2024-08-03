<x-jetstream.form-section submit="update">
    <x-slot name="title">
        {{ __('Social media and website') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add links to your social media profiles to provide more context about your organization') }}
    </x-slot>

    <x-slot name="form">

        <!--- Social media -->
        <div class="col-span-6 sm:col-span-4">
            @livewire('socials-form')
            <x-jetstream.input-error for="socials" class="mt-2" />
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

    <x-slot name="actions">
        <x-jetstream.action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jetstream.action-message>

        <x-jetstream.button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jetstream.button>
    </x-slot>
</x-jetstream.form-section>

