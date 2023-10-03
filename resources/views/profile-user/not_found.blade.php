<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900">
            {{ __('User not found') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                <div class="border-b border-gray-200 bg-white p-6 sm:px-20">

                    <div class="mt-12">
                        <!-- TODO: insert not found image here -->

                        <div class="mt-8 text-5xl font-bold text-gray-900">
                            {{ __('Sorry, we can not find this user') }}
                        </div>


                    </div>
                    <div class="mb-12 mt-6 flex justify-between">
                        <span class="text-xl font-bold text-gray-900">{{ __('See the top right of this page to switch to another language.') }}
                        </span>
                        <div class="flex justify-end">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
                                    </svg>
                            <a class="mb-2 ml-2 hidden font-bold text-gray-900 sm:block"
                                href="{{ url()->previous() }}">{{ __('Previous page') }}<a>
                                

                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>


<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20" stroke-width="1.5" stroke="currentColor"
    class="h-6 w-6">
    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 15.75L3 12m0 0l3.75-3.75M3 12h18" />
</svg>
