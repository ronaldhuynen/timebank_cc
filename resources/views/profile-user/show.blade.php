<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ __('Your Personal Profile') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        @livewire('profile-user.update-profile-personal-form')
        <x-jet-section-border />
        @livewire('profile-user.update-profile-location-form')
        <x-jet-section-border />
        <x-profile-user.skills />
    </div>

</x-app-layout>
