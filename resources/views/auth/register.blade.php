<x-guest-layout>
    <x-jet-authentication-card>

        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <!--- Left section -->
        <x-jet-section-title>
            <x-slot name="title">{{ __('Registration') }}</x-slot>
            <x-slot name="description">
                <div class="my-4">{{ __('The provided name will be shown in transactions, messages and search results within our platform.') }}</div>
                <div class="my-4">{{ __('We will never share your personal data with third parties and it will always be easy for your to review or to remove it.') }}</div>
                <div class="my-4">{{ __('Timebank.cc is a non-profit association, founded to fascilitate the exchange of worked time among their users.') }}</div>

                <!--- Stepper --->
                <h1 class="mt-12 text-gray-500">{{ __('Step 1 of 3') }}</h1>
                <div class="mb-10 mt-2 relative inset-x-0 bottom-0 h-4  rounded-full overflow-hidden">
                    <div class=" w-full h-full bg-gray-200 absolute "></div>
                    <div class=" h-full bg-gray-500 absolute" style="width:33%"></div>
                </div>

            </x-slot>
        </x-jet-section-title>

        <div class="mt-5 md:mt-0 md:col-span-2">
            <x-jet-validation-errors class="mb-4" />

            <!---- Right section --->
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">


             <div class="my-3 text-xl">
                 {{ __('Hello, what is your name?') }}
             </div>

                <div class="grid grid-cols-6 gap-6">
                   <div class="col-span-6 sm:col-span-4">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="mt-4">
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                            </div>

                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <x-jet-button class="ml-4">
                            {{ __('Next') }}
                        </x-jet-button>
                    </div>

                </form>


            </div>
        </div>



    </x-jet-authentication-card>



</x-guest-layout>
