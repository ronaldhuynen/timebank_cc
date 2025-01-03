<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            {{ __('User settings') }}
        </div>
    </x-slot>

    <div class="mx-auto max-w-7xl py-10 sm:px-6 lg:px-8">
        @livewire('profile.update-settings-form')
    </div>
</x-app-layout>
