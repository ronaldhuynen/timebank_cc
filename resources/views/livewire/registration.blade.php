                <div class="grid grid-cols-6 gap-6">
                   <div class="col-span-6 sm:col-span-4">
                      <form wire:submit.prevent="create">
                        <input type="hidden" name="remember" value="true">
                            @csrf

                            <div class="mt-4">
                                <!-- TODO: Pubic username or real name?? Use placeholder or label to clarify -->
                                <x-jet-label for="name" value="{{ __('Name') }}" />
                                <x-jet-input wire:model.lazy="name" name="name" type="text" required autofocus autocomplete="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"/>
                            </div>
                            @error('name')
                                <p class="text-sm text-red-500">{{$message}}</p>
                            @enderror

                            <div class="mt-4">
                                <x-jet-label for="email" value="{{ __('Email') }}" />
                                <x-jet-input wire:model.lazy="email" name="email" type="email" required class="block mt-1 w-full" :value="old('email')"/>
                            </div>
                            @error('email')
                                <p class="text-sm text-red-500">{{$message}}</p>
                            @enderror

                            <div class="mt-4">
                                <x-jet-label for="password" value="{{ __('Password') }}" />
                                <x-jet-input wire:model.lazy="password" name="password" type="password" autocomplete="new-password" required class="block mt-1 w-full"/>
                            </div>

                            <div class="mt-4">
                                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                                <x-jet-input wire:model.lazy="passwordConfirmation" name="passwordConfirmation" type="password" required class="block mt-1 w-full"/>
                            </div>
                            @error('password')
                                <p class="text-sm text-red-500">{{$message}}</p>
                            @enderror
                            <div class="mt-4">
                                <!-- TODO: Explanantion for location dropdowns -->
                                @livewire('locations.locations-dropdown')
                            @error('country')
                                <p class="text-sm text-red-500">{{$message}}</p>
                            @enderror
                            @error('city')
                                <p class="text-sm text-red-500">{{$message}}</p>
                            @enderror
                            </div>

                          </div>
                      </div>

                      <div class="flex items-center justify-end mt-4">
                          <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                              {{ __('Already registered?') }}
                          </a>
                          <x-jet-button class="ml-4">
                              {{ __('Submit') }}
                          </x-jet-button>
                      </div>

                    </form>
