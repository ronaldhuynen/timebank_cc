@php
    $layout = Auth::check() ? 'app-layout' : 'guest-layout';
@endphp

<x-dynamic-component :component="$layout">
    <div class=" mt-48 mb-36 flex flex-col items-center justify-center">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-gray-200">401</h1>
        <p class="text-lg text-gray-600 dark:text-gray-400 mt-4">{{ __('Unauthorized') }}</p>
        <button onclick="history.back()" class="mt-6 px-4 py-2 bg-gray-900 text-gray-100 rounded hover:bg-black hover:text-white">
            {{ __('Go back') }}
        </button>
    </div>
</x-dynamic-component>