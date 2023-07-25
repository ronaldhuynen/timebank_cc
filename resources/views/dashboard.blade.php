<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            @if(session('login-success'))
            {{ session('login-success') }}
            @else
            {{ __('Dashboard') }}
            @endif
        </h2>
    </x-slot>

    @if(Session::has('success'))
        <livewire:notify-switch-profile>
    @endif


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div>
    </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:dashboard>
            </div>
        </div>
    </div>
</x-app-layout>
