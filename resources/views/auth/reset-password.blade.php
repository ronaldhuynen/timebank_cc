<x-guest-layout>
    <x-jetstream.authentication-card>
        <x-slot name="logo">
            <x-jetstream.authentication-card-logo />
        </x-slot>

        <x-jetstream.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jetstream.label for="email" value="{{ __('Email') }}" />
                <x-jetstream.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jetstream.label for="password" value="{{ __('Password') }}" />
                <x-jetstream.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jetstream.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jetstream.input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jetstream.button>
                    {{ __('Reset Password') }}
                </x-jetstream.button>
            </div>
        </form>
    </x-jetstream.authentication-card>
</x-guest-layout>
