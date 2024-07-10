<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ __('Update your organization profile') }}
        </h2>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">

        @livewire('profile-org.update-profile-org-form')
        <x-jet-section-border />
        @livewire('profile-org.update-profile-location-form')
        <x-jet-section-border />
        @livewire('profile.update-profile-skills-form')
    </div>

</x-app-layout>
