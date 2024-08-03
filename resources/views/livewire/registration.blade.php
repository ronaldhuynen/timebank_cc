                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <form wire:submit="create">
                            <input name="remember" type="hidden" value="true">
                            @csrf
                            {{-- @hiddencaptcha --}}

                            <div class="mt-4">
                                <!-- TODO: Pubic username or real name?? Use placeholder or label to clarify -->
                                <x-jetstream.label for="name" value="{{ __('Name') }}" />
                                <x-jetstream.input :value="old('name')" autocomplete="name" autofocus class="mt-1 block w-full"
                                             name="name" name="name" required type="text" type="text"
                                             wire:model.blur="name" />
                            </div>
                            @error('name')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror

                            <div class="mt-4">
                                <x-jetstream.label for="email" value="{{ __('Email') }}" />
                                <x-jetstream.input :value="old('email')" class="mt-1 block w-full" name="email" required
                                             type="email" wire:model.blur="email" />
                            </div>
                            @error('email')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror

                            <div class="mt-4">
                                <x-jetstream.label for="password" value="{{ __('Password') }}" />
                                <x-jetstream.input autocomplete="new-password" class="mt-1 block w-full" name="password"
                                             required type="password" wire:model.blur="password" />
                            </div>

                            <div class="mt-4">
                                <x-jetstream.label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jetstream.input class="mt-1 block w-full" name="passwordConfirmation" required
                                             type="password" wire:model.blur="passwordConfirmation" />
                            </div>
                            @error('password')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror
                            <div class="mt-4" wire:init="emitLocationToChildren">
                                @livewire('locations.locations-dropdown')
                                @error('country')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                @error('division')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                                @error('city')
                                    <p class="text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            @error('captcha')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror

                    </div>
                </div>

                <div class="mt-4 flex items-center justify-end">
                    @if ($waitMessage)
                        <span>{{ __('Please wait...') }}</span>
                    @else
                        <a class="text-sm text-gray-600 underline hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                    @endif
                    <x-jetstream.button class="ml-4">
                        {{ __('Submit') }}
                    </x-jetstream.button>
                </div>

                </form>
