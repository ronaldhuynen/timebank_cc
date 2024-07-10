<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            @if (session('login-success'))
                {{ session('login-success') }}
            @else
                {{ __('Dashboard') }}
            @endif
        </h2>
    </x-slot>

    {{-- Show the notification message that profile has been switched --}}
    @if (Session::has('success'))
        <livewire:notify-switch-profile>
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
