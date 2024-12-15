<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            {{ __('Update your organization profile') }}
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">

        @livewire('profile-org.update-profile-org-form')
        <x-jetstream.section-border />
        @livewire('locations.update-profile-location-form')
        <x-jetstream.section-border />
        @livewire('profile.update-profile-skills-form')
    </div>

</x-app-layout>
