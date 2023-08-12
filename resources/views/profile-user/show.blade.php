<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Your Personal Profile') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                @livewire('profile-user.update-profile-personal-form')
                <x-jet-section-border />
                @livewire('profile-user.update-profile-location-form')
                <x-jet-section-border />
                @livewire('profile-user.update-skills-form')
        </div>
    </div>
</x-app-layout>
