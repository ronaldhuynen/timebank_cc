<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-900 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">

                    <div class="mt-4 text-2xl">
                        {{ __('Posts Index') }}
                    </div>

                    <div class="mt-6 text-gray-500">
                        {{__('Here we can write some additional info about this page. Of course only if we need to. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in vol ')}}

                    </div>

                    <!--- Admin section -->
                    @livewire('posts')


                </div>
            </div>
        </div>

</x-app-layout>

