<x-guest-layout>
    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <!--- Left section -->
        <x-section-title>
            <x-slot name="title">{{ __('Registration') }}</x-slot>
            <x-slot name="description">
                <div class="my-4">
                    {{ __('The provided name will be shown in transactions, messages and search results within our platform.') }}
                </div>
                <div class="my-4">
                    {{ __('We will never share your personal data with third parties and it will always be easy for your to review or to remove it.') }}
                </div>
                <div class="my-4">
                    {{ __('Timebank.cc is a non-profit association, founded to fascilitate the exchange of worked time among their users.') }}
                </div>

                <!--- Stepper --->
                <h1 class="mt-12 text-gray-500">{{ __('Step 2 of 2') }}</h1>
                <div class="relative inset-x-0 bottom-0 mb-10 mt-2 h-4 overflow-hidden rounded-full">
                    <div class="absolute h-full w-full bg-gray-200"></div>
                    <div class="absolute h-full bg-gray-500" style="width:100%"></div>
                </div>

            </x-slot>
        </x-section-title>

        <div class="mt-5 md:col-span-2 md:mt-0">
            <x-validation-errors class="mb-4" />

            <!---- Right section --->
            <div class="bg-white px-4 py-5 shadow sm:rounded-tl-md sm:rounded-tr-md sm:p-6">

                <div class="my-3 text-xl">
                    {{ __('Hello, what is your name?') }}
                </div>

                @livewire('registration')

            </div>
        </div>

    </x-authentication-card>
</x-guest-layout>
