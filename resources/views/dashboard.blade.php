<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            @if (session('login-success'))
                {{ session('login-success') }}
            @else
                {{ __('Dashboard') }}
            @endif
        </div>
    </x-slot>

    @if (session('unauthorizedAction'))
        <div class="alert alert-danger">
            <livewire:notify-unauthorized-action>
        </div>
    @endif

    {{-- Show the notification message that profile has been switched --}}
    @if (session('profile-switched-notification'))
        <livewire:notify-switch-profile>
    @endif

    {{-- Show the notification message that the email address has been verified --}}
    @if (session('email-verified'))
        <livewire:notify-email-verified>
    @endif


    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <livewire:dashboard>
            </div>
        </div>
    </div>
</x-app-layout>
