<x-guest-layout>
    <x-jetstream.authentication-card>
        <x-slot name="logo">
            <x-jetstream.authentication-card-logo />
        </x-slot>

        <x-jetstream.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jetstream.label for="name" value="{{ __('Name') }}" />
                <x-jetstream.input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-jetstream.label for="email" value="{{ __('Email') }}" />
                <x-jetstream.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <div class="mt-4">
                <x-jetstream.label for="password" value="{{ __('Password') }}" />
                <x-jetstream.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jetstream.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jetstream.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jetstream.label for="terms">
                        <div class="flex items-center">
                            <x-jetstream.checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jetstream.label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jetstream.button class="ml-4">
                    {{ __('Register') }}
                </x-jetstream.button>
            </div>
        </form>
    </x-jetstream.authentication-card>
</x-guest-layout>
