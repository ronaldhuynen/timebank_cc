<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ __('Update your profile') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        
        @livewire('profile-user.update-profile-personal-form')
        <x-jetstream.section-border />
        @livewire('profile-user.update-profile-location-form')
        <x-jetstream.section-border />
        @livewire('profile.update-profile-skills-form')

    </div>

</x-app-layout>
