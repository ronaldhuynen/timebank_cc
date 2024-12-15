<x-app-layout>
    <x-slot name="header">
        <div class="text-sm font-semibold leading-tight text-gray-100">
            {{ __('Getting started') }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-3 sm:px-0">
                        @livewire('static-post', ['type' => 'SiteContents\Static\GettingStarted' ?? null, 'limit' => 1 ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
