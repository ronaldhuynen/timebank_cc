<x-app-layout>
    <x-slot name="header">
        <div class="mt-2 text-xl font-semibold leading-tight text-gray-100">
            {{ __('Meet the team') }}
        </div>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div>
            </div>
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="px-3 sm:px-0">
                        @livewire('static-post', ['type' => 'SiteContents\Static\Team' ?? null, 'limit' => 2 ])
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
