<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Locations') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Where is your organization located? And what is a good place for Timebank.cc exchanges?') }}
    </x-slot>

    <x-slot name="form">

        <!--- Location -->
        <div class="col-span-6 sm:col-span-4"  wire:init="emitLocationToChildren">
        <!-- TODO: Explanantion for location dropdowns -->
            @livewire('locations.locations-dropdown')
            @error('country')
                <p class="text-sm text-red-500">{{$message}}</p>
            @enderror
            @error('division')
                <p class="text-sm text-red-500">{{$message}}</p>
            @enderror
            @error('city')
                <p class="text-sm text-red-500">{{$message}}</p>
            @enderror
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>

