@php
    $layout = Auth::check() ? 'app-layout' : 'guest-layout';
@endphp

<x-dynamic-component :component="$layout">
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            {{ __('Lekkernassûh') }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-3 sm:px-0">
                    @livewire('static-post', ['type' => 'SiteContents\Static\Lekkernassuh' ?? null, 'limit' => 1 ])
                </div>
            </div>
        </div>
    </div>
</x-dynamic-component>