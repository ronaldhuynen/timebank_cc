<x-guest-layout>
    <x-jetstream.authentication-card>
        <x-slot name="logo">
            <x-jetstream.authentication-card-logo />
        </x-slot>

        <x-jetstream.validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jetstream.label for="auth" value="{{ __('Email or Username') }}" />
                <x-jetstream.input id="auth" class="block mt-1 w-full" type="text" name="auth" :value="old('auth')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jetstream.label for="password" value="{{ __('Password') }}" />
                <x-jetstream.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jetstream.checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jetstream.button class="ml-4">
                    {{ __('Log in') }}
                </x-jetstream.button>
            </div>
        </form>
    </x-jetstream.authentication-card>
</x-guest-layout>
