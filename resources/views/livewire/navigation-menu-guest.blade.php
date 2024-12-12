<nav class="bg-white shadow-md border-b border-gray-100 fixed top-0 left-0 right-0 z-50" x-data="{ open: false }">
    @guest
        <!-- Primary Navigation Menu -->
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="flex h-16 items-center justify-between">
                <!-- Logo -->
                <div class="flex shrink-0 items-center">
                    <a href="{{ route('welcome') }}">
                        <x-jetstream.application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden ml-auto items-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                  
                
                           <!-- Language selector ---->
                <!-- This changes the session('locale') and by the Middleware StoreUserLangPreference this locale
                    is stored as the lang_preference in the user table -->
                @php
                    $languages = Illuminate\Support\Facades\DB::table('languages')->orderBy('lang_code', 'asc')->get();
                    $supportedLocales = LaravelLocalization::getSupportedLocales();
                    // Sort the supported locales alphabetically by the language name
                    uasort($supportedLocales, function ($a, $b) {
                        return strcmp($a['native'], $b['native']);
                    });
                @endphp
                <div class="flex-end ml-3 flex">
                    <x-jetstream.dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button class="inline-flex items-center rounded-md bg-white px-4 py-2 text-sm font-medium leading-4 text-gray-500 transition hover:bg-gray-50 hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50"
                                        type="button">

                                    {{ $languages->where('lang_code', app()->getLocale())->value('flag') }}

                                </button>
                            </span>
                        </x-slot>
                        <!-- Language select options -->
                        <x-slot name="content">
                            <div class="w-60">
                                @foreach ($supportedLocales as $localeCode => $properties)
                                    @php
                                        $language = $languages->firstWhere('lang_code', strtolower($localeCode));
                                    @endphp
                                    @if ($language)
                                        <div class="block px-4 py-2">
                                            <a class="text-gray-900 transition hover:text-gray-700 focus:border-gray-300 focus:text-gray-700"
                                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}"
                                               hreflang="{{ $localeCode }}" rel="alternate">
                                                {{ $language->flag }}
                                                <span
                                                      class="ml-3 text-gray-400">{{ Lang::get($language->name, [], $localeCode) }}
                                                </span>
                                            </a>
                                        </div>
                                    @endif
                                @endforeach
                                </div>
                            </div>
                        </x-slot>
                    </x-jetstream.dropdown>
                </div>
                 @if (Route::has('login'))
                <div class="hidden top-0 right-0 py-4 sm:block">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Dashboard') }}</a>
                    @else
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Register') }}</a>
                        @endif

                        <a href="{{ route('login') }}" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">{{ __('Log in') }}</a>
                    @endauth
                </div>
            @endif
            </div>

            <div class="hidden sm:ml-6 sm:flex sm:items-center">

     
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 transition hover:bg-gray-100 hover:text-gray-500 focus:bg-gray-100 focus:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                              d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" d="M6 18L18 6M6 6l12 12"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
            <div class="space-y-1 pb-3 pt-2">
              
            </div>


        </div>
    @endguest
</nav>
