                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <form wire:submit.prevent="create">
                            <input name="remember" type="hidden" value="true">
                            @csrf
                            {{-- @hiddencaptcha --}}

                            <div class="mt-4">
                                <!-- TODO: Pubic username or real name?? Use placeholder or label to clarify -->
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input :value="old('name')" autocomplete="name" autofocus class="mt-1 block w-full"
                                             name="name" name="name" required type="text" type="text"
                                             wire:model.lazy="name" />
                            </div>
                            @error('name')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input :value="old('email')" class="mt-1 block w-full" name="email" required
                                             type="email" wire:model.lazy="email" />
                            </div>
                            @error('email')
                                <p class="text-sm text-red-500">{{ $message }}</p>
                            @enderror

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input autocomplete="new-password" class="mt-1 block w-full" name="password"
                                             required type="password" wire:model.lazy="password" />
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input class="mt-1 block w-full" name="passwordConfirmation" required
                                             type="password" wire:model.lazy="passwordConfirmation" />
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
                    <x-jet-button class="ml-4">
                        {{ __('Submit') }}
                    </x-jet-button>
                </div>

                </form>
