<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-section-title>
            <x-slot name="title">{{ __('Please introduce yourself') }}</x-slot>
            <x-slot name="description">
                <div class="my-4">{{ __('Other Timebankers like to know who you are before they start their first exchange with you.') }}</div>
                <div class="my-4">{{ __('Explaining why you like to be part of our time economy can also help with getting new exhanges.') }}</div>

                <!--- Stepper --->
                <h1 class="mt-12 text-gray-500">{{ __('Step 2 of 3') }}</h1>
                <div class="mb-10 mt-2 relative inset-x-0 bottom-0 h-4  rounded-full overflow-hidden">
                    <div class=" w-full h-full bg-gray-200 absolute "></div>
                    <div class=" h-full bg-gray-500 absolute" style="width:66%"></div>
                </div>

            </x-slot>
        </x-jet-section-title>


        <div class="mt-5 md:mt-0 md:col-span-2">
            <x-jet-validation-errors class="mb-4" />

            <!---- Right section --->
            <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                <div class="mt-0 text-2xl">
                    {{ __('') }}
                </div>

                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">

                            <form method="POST" action="{{ route('register-step2.create') }}" enctype="multipart/form-data">
                                @csrf




                                <div class="mt-4">
                                    <x-jet-label for="photo" value="{{ __('Profile photo') }}" />
                                    <input type="file" name="photo"/>
                                </div>


                                <div class="mt-4">
                                    <x-jet-label for="about" value="{{ __('Short intro about yourself') }}" />
                                    <x-jet-input id="about" class="block mt-1 w-full" type="text" name="about" :value="old('about')" required autofocus autocomplete="about" />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="motivation" value="{{ __('Why do you like to joinTimebank.cc?') }}" />
                                    <x-jet-input id="motivation" class="block mt-1 w-full" type="text" name="motivation" :value="old('motivation')" required autofocus autocomplete="motivation" />
                                </div>

                                <div class="mt-4">
                                    <x-jet-label for="date_of_birth" value="{{ __('Date of birth') }}" />
                                    <x-jet-input id="date_of_birth" class="block mt-1 w-full" type="text" name="date_of_birth" :value="old('date_of_birth')" required autofocus autocomplete="date_of_birth" />
                                </div>


                                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                <div class="mt-4">
                                    <x-jet-label for="terms">
                                        <div class="flex items-center">
                                            <x-jet-checkbox name="terms" id="terms" />

                                            <div class="ml-2">
                                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </x-jet-label>
                                </div>
                                @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        <x-jet-button class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>

                    </form>

                </div>
            </div>
    </x-jet-authentication-card>
</x-guest-layout>
