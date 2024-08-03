<x-guest-layout>
    <x-jetstream.authentication-card>
        <x-slot name="logo">
            <x-jetstream.authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-jetstream.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-jetstream.label for="password" value="{{ __('Password') }}" />
                <x-jetstream.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-jetstream.button class="ml-4">
                    {{ __('Confirm') }}
                </x-jetstream.button>
            </div>
        </form>
    </x-jetstream.authentication-card>
</x-guest-layout>
