<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
        @if (count($results) > 1)
            {{ __('Search') . ': ' . count($results) . ' ' . __('results') }}
        @elseif (count($results) === 1)
            {{ __('Search') . ': ' . count($results) . ' ' . __('result') }}
        @else
            {{ __('Search') . ': ' . __('No results found, please search again') }}
        @endif
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">

                <!-- Display search results -->
                @livewire('search.show', ['results' => $results])

            </div>
        </div>
</x-app-layout>
