<x-jetstream.form-section submit="updateProfileInformation">
        <x-slot name="title">
        </x-slot>

        <x-slot name="description">
                <div class="">
                    @livewire('side-post', [
                        'type' => 'SiteContents\User\Edit\Location' ?? null, 
                        'sticky' => false, 'random' => true, 
                        'fallbackTitle' => __('Location'),
                        'fallbackDescription' => __('Most exchanges take place in your own area. Please indicate where this is so you can easily meet other Timebankers who are around.') ]),
                </div>
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
        <x-jetstream.action-message class="mr-3" on="saved">
            {{ __('Saved') }}
        </x-jetstream.action-message>

        <x-jetstream.button wire:loading.attr="disabled" wire:target="updateProfileInformation" wire:click="updateProfileInformation">
            {{ __('Save') }}
        </x-jetstream.button>
    </x-slot>
</x-jetstream.form-section>

