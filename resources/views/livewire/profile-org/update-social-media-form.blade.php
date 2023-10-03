<x-jet-form-section submit="update">
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
            <x-jet-input-error for="socials" class="mt-2" />
        </div>

        <!-- Website -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="website" value="{{ __('Organization Website') }}" />
            <x-input
                placeholder="website.org"
                wire:model.lazy="website"
                class="placeholder-gray-300"
            />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>

