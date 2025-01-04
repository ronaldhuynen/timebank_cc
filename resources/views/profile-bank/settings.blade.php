<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            {{ __('Bank settings') }}
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        @livewire('profile.update-settings-form')
        <x-jetstream.section-border />
        
        @livewire('profile.update-profile-phone-form')
        <x-jetstream.section-border />

        <div class="mt-10 sm:mt-0">
            @livewire('profile.update-message-settings-form')
        </div>
    </div>
    
</x-app-layout>
