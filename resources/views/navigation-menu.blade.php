<nav class="border-b border-gray-100 bg-white" x-data="{ open: false }">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <x-notifications />
        <div class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex shrink-0 items-center">
                <a href="{{ route('dashboard') }}">
                    <x-jetstream.application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden items-center space-x-8 sm:-my-px sm:ml-10 sm:flex">
                <x-jetstream.nav-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                    {{ __('Dashboard') }}
                </x-jetstream.nav-link>

                <!-- Only if activeProfile has any accounts -->
                @if (session('activeProfileAccounts'))
                    <x-jetstream.nav-link :active="request()->routeIs('pay')" href="{{ route('pay') }}">
                        {{ __('Pay') }}
                    </x-jetstream.nav-link>
                    <x-jetstream.nav-link :active="request()->routeIs('pay')" href="{{ route('transactions') }}">
                        {{ __('Transactions') }}
                    </x-jetstream.nav-link>
                @endif

                <x-jetstream.nav-link :active="request()->routeIs('user.edit')" href="{{ route('user.edit') }}">
                    {{ __('Commons') }}
                </x-jetstream.nav-link>
                @can('manage posts')
                    <x-jetstream.nav-link :active="request()->routeIs('posts.manage')" href="{{ route('posts.manage') }}">
                        {{ __('Posts') }}
                    </x-jetstream.nav-link>
                @endcan
                <!-- Main Search Bar -->
                @livewire('main-search-bar')
            </div>
        </div>

        <div class="hidden sm:ml-6 sm:flex sm:items-center">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="flex-end ml-3 flex">
                    <x-jetstream.dropdown align="right" width="60">
                        <x-slot name="trigger">
                            <span class="inline-flex rounded-md">
                                <button class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition hover:bg-gray-50 hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50"
                                        type="button">
                                    {{-- {{ Auth::user()->currentTeam->name }} --}}
                                    <svg class="-mr-0.5 ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                              fill-rule="evenodd" />
                                    </svg>

                                </button>
                            </span>
                        </x-slot>

                        <x-slot name="content">
                            <div class="w-60">
                                <!-- Team Management -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Manage Team') }}
                                </div>

                                <!-- Team Settings -->
                                <x-jetstream.dropdown-link
                             href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                    {{ __('Team Settings') }}
                                </x-jetstream.dropdown-link>

                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                    <x-jetstream.dropdown-link href="{{ route('teams.create') }}">
                                        {{ __('Create New Team') }}
                                    </x-jetstream.dropdown-link>
                                @endcan

                                <div class="border-t border-gray-100"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    {{ __('Switch Teams') }}
                                </div>

                                @foreach (Auth::user()->allTeams() as $team)
                                    <x-jetstream.switchable-team :team="$team" />
                                @endforeach
                            </div>
                        </x-slot>
                    </x-jetstream.dropdown>
                </div>
            @endif

            <!-- Language selector ---->
            <!-- This changes the session('locale') and by the Middleware StoreUserLangPreference this locale
                is stored as the lang_preference in the user table
                -->
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
                            <button class="inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition hover:bg-gray-50 hover:text-gray-700 focus:bg-gray-50 focus:outline-none active:bg-gray-50"
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
                    </x-slot>
                </x-jetstream.dropdown>
            </div>

            <!-- Settings / Profile Dropdown -->
            <div class="bloc text-s text-grey-500 ml-3 py-0">
                {{ Session('activeProfileName') }}
            </div>

            <div class="relative ml-2">
                <x-jetstream.dropdown align="right" width="48">
                    <x-slot name="trigger">

                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button
                                    class="border-1 hover:border-grey-900 focus:border-grey-900 flex rounded-full border-2 border-white text-sm shadow-sm transition focus:border-gray-300">
                                <img alt="{{ Session('activeProfileName') }}" class="h-9 w-9 rounded-full object-cover"
                                     src="{{ Storage::url(Session('activeProfilePhoto')) }}" />
                            </button>
                        @else
                            <span class="inline-flex rounded-md">
                                <button class="inline-flex items-center rounded-md border border-transparent bg-white px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition hover:text-gray-700 focus:outline-none"
                                        type="button">
                                    {{ Session('activeProfileName') }}

                                    <svg class="-mr-0.5 ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20"
                                         xmlns="http://www.w3.org/2000/svg">
                                        <path clip-rule="evenodd"
                                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                              fill-rule="evenodd" />
                                    </svg>

                                </button>
                            </span>
                        @endif
                        <span class="badge-pill badge-danger mr-n2 badge" id="nav_mobile_total_count"></span>

                    </x-slot>

                    <x-slot name="content">

                        <!---- Switch Profile --->
                         @if (Auth::user()->organizations->isNotEmpty())
                            <livewire:select-organization>
                        @endif

                        <!---- Edit profile --->
                        @if (session('activeProfileType') == 'App\Models\User')
                            <x-jetstream.dropdown-link :active="request()->routeIs('user.edit')" href="{{ route('user.edit') }}">
                                {{ __('Edit Profile') }}
                            </x-jetstream.dropdown-link>
                        @elseif (session('activeProfileType') == 'App\Models\Organization')
                            <x-jetstream.dropdown-link :active="request()->routeIs('org.show')" href="{{ route('org.edit') }}">
                                {{ __('Edit profile') }}
                            </x-jetstream.dropdown-link>
                        @endif

                        <!--- Messenger --->
                        <x-jetstream.dropdown-link href="{{ route('messenger.portal') }}">
                            {{ __('Messages') }} <span class="badge-pill badge-danger mr-n2 badge"
                                  id="nav_thread_count"></span>
                        </x-jetstream.dropdown-link>

                        <!--- Messender Friends --->
                        <div class="nav-item dropdown block px-4 py-2 text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                             id="pending_friends_nav">
                            <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown block pb-0 pt-1"
                               data-toggle="dropdown" href="#" id="click_friends_tab" onClick="drop()">
                                {{ __('Friends') }} <span class="badge-pill badge-danger mr-n2 badge"
                                      id="nav_friends_count"></span>
                            </a>

                            <div aria-labelledby="click_friends_tab"
                                 class="dropdown-menu dropdown-menu-right notify-drop bg-light">
                                <div class="row">
                                    <div class="col-12 pill-tab-nav">
                                        <nav class="nav nav-pills flex-column flex-sm-row" id="nav-friend-tabs"
                                             role="tablist">
                                            <a aria-controls="f_pending" aria-selected="true"
                                               class="flex-sm-fill text-sm-center nav-link h6 active" data-toggle="pill"
                                               href="#f_pending" id="tab-pending" role="tab"><i
                                                   class="fas fa-user-friends"></i> Pending</a>
                                            <a aria-controls="f_sent" aria-selected="false"
                                               class="flex-sm-fill text-sm-center nav-link h6" data-toggle="pill"
                                               href="#f_sent" id="tab-sent" role="tab"><i
                                                   class="fas fa-user-friends"></i> Sent</a>
                                        </nav>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="f_pending">
                                        <div class="drop-content list-group" id="pending_friends_ctnr">
                                            <div class="col-12 text-center">
                                                <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="f_sent">
                                        <div class="drop-content list-group" id="sent_friends_ctnr">
                                            <div class="col-12 text-center">
                                                <div class="spinner-grow spinner-grow-sm text-primary" role="status">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!---- Settings --->
                        <x-jetstream.dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Settings') }}
                        </x-jetstream.dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jetstream.dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jetstream.dropdown-link>
                        @endif

                        <div class="border-t border-gray-200"></div>

                        <!-- Log out -->
                        <form action="{{ route('logout') }}" method="POST" x-data>
                            @csrf
                            <x-jetstream.dropdown-link @click.prevent="$root.submit();" href="{{ route('logout') }}">
                                {{ __('Log Out') }}
                            </x-jetstream.dropdown-link>
                        </form>
                    </x-slot>
                </x-jetstream.dropdown>
            </div>
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
            <x-jetstream.responsive-nav-link :active="request()->routeIs('dashboard')" href="{{ route('dashboard') }}">
                {{ __('Dashboard') }}
            </x-jetstream.responsive-nav-link>
            <x-jetstream.responsive-nav-link :active="request()->routeIs('pay')" href="{{ route('pay') }}">
                {{ __('Tranfer') }}
            </x-jetstream.responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="border-t border-gray-200 pb-1 pt-4">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="mr-3 shrink-0">
                        <img alt="{{ Auth::user()->name }}" class="h-10 w-10 rounded-full object-cover"
                             src="{{ Auth::user()->profile_photo_url }}" />
                    </div>
                @endif

                <div>
                    <div class="text-base font-medium text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->

                <!---- Switch Profile --->
                @if (Auth::user()->organizations->isNotEmpty())
                    <livewire:select-organization>
                @endif

                <!---- Edit profile --->
                @if (session('activeProfileType') == 'App\Models\User')
                    <x-jetstream.dropdown-link :active="request()->routeIs('user.edit')" href="{{ route('user.edit') }}">
                        {{ __('Edit Profile') }}
                    </x-jetstream.dropdown-link>
                @elseif (session('activeProfileType') == 'App\Models\Organization')
                    <x-jetstream.dropdown-link :active="request()->routeIs('org.show')" href="{{ route('org.edit') }}">
                        {{ __('Edit profile') }}
                    </x-jetstream.dropdown-link>
                @endif

                <!--- Messenger --->
                <x-jetstream.dropdown-link href="{{ route('messenger.portal') }}">
                    {{ __('Messages') }} <span class="badge-pill badge-danger mr-n2 badge"
                          id="nav_thread_count"></span>
                </x-jetstream.dropdown-link>

                <!--- Messender Friends --->
                <div class="nav-item dropdown block px-4 py-2 text-sm leading-5 text-gray-700 transition hover:bg-gray-100 focus:bg-gray-100 focus:outline-none"
                     id="pending_friends_nav">
                    <a aria-expanded="false" aria-haspopup="true" class="nav-link dropdown block pb-0 pt-1"
                       data-toggle="dropdown" href="#" id="click_friends_tab" onClick="drop()">
                        {{ __('Friends') }} <span class="badge-pill badge-danger mr-n2 badge"
                              id="nav_friends_count"></span>
                    </a>

                    <div aria-labelledby="click_friends_tab"
                         class="dropdown-menu dropdown-menu-right notify-drop bg-light">
                        <div class="row">
                            <div class="col-12 pill-tab-nav">
                                <nav class="nav nav-pills flex-column flex-sm-row" id="nav-friend-tabs"
                                     role="tablist">
                                    <a aria-controls="f_pending" aria-selected="true"
                                       class="flex-sm-fill text-sm-center nav-link h6 active" data-toggle="pill"
                                       href="#f_pending" id="tab-pending" role="tab"><i
                                           class="fas fa-user-friends"></i> Pending</a>
                                    <a aria-controls="f_sent" aria-selected="false"
                                       class="flex-sm-fill text-sm-center nav-link h6" data-toggle="pill"
                                       href="#f_sent" id="tab-sent" role="tab"><i
                                           class="fas fa-user-friends"></i> Sent</a>
                                </nav>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="f_pending">
                                <div class="drop-content list-group" id="pending_friends_ctnr">
                                    <div class="col-12 text-center">
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="f_sent">
                                <div class="drop-content list-group" id="sent_friends_ctnr">
                                    <div class="col-12 text-center">
                                        <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!---- Settings --->
                <x-jetstream.dropdown-link href="{{ route('profile.show') }}">
                    {{ __('Settings') }}
                </x-jetstream.dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jetstream.responsive-nav-link :active="request()->routeIs('api-tokens.index')" href="{{ route('api-tokens.index') }}">
                        {{ __('API Tokens') }}
                    </x-jetstream.responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form action="{{ route('logout') }}" method="POST" x-data>
                    @csrf

                    <x-jetstream.responsive-nav-link @click.prevent="$root.submit();" href="{{ route('logout') }}">
                        {{ __('Log Out') }}
                    </x-jetstream.responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jetstream.responsive-nav-link :active="request()->routeIs('teams.show')"
                                                     href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                        {{ __('Team Settings') }}
                    </x-jetstream.responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jetstream.responsive-nav-link :active="request()->routeIs('teams.create')" href="{{ route('teams.create') }}">
                            {{ __('Create New Team') }}
                        </x-jetstream.responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jetstream.switchable-team :team="$team" component="responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!--- Force dropdown of Messenger Friend menu --->
    <script>
        function drop() {
            $('#click_friends_tab').dropdown();
        };
    </script>

    {{-- <script>
        window.Pusher.logToConsole = true;
        window.Echo.private('switchProfile')
        .listen('ProfileSwitchEvent', (e) => {
             window.location.reload();
             });

    </script> --}}

</nav>
