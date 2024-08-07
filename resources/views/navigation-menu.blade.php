<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <x-notifications />
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="shrink-0 flex items-center">
                <a href="{{ route('dashboard') }}">
                    <x-jet-application-mark class="block h-9 w-auto" />
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-8 items-center sm:-my-px sm:ml-10 sm:flex">
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Dashboard') }}
                </x-jet-nav-link>
    
                <!-- Only if activeProfile has any accounts -->
                @if ( session('activeProfileAccounts') )
                        <x-jet-nav-link href="{{ route('transfer') }}" :active="request()->routeIs('transfer')">
                            {{ __('Payments') }}
                        </x-jet-nav-link>
                @endif


                <x-jet-nav-link href="{{ route('user.edit') }}" :active="request()->routeIs('user.edit')">
                    {{ __('Commons') }}
                </x-jet-nav-link>
                @can('manage posts')
                <x-jet-nav-link href="{{ route('posts.manage') }}" :active="request()->routeIs('posts.manage')">
                    {{ __('Posts') }}
                </x-jet-nav-link>
                @endcan
                <!-- Main Search Bar -->
                {{-- <div class="ml-3 relative"> --}}
                @livewire('main-search-bar')
                {{-- </div> --}}
            </div>
        </div>


        <div class="hidden sm:flex sm:items-center sm:ml-6">
            <!-- Teams Dropdown -->
            @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
            <div class="flex flex-end ml-3">
                <x-jet-dropdown align="right" width="60">
                    <x-slot name="trigger">
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition">
                                {{-- {{ Auth::user()->currentTeam->name }} --}}
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
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
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                            <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                {{ __('Create New Team') }}
                            </x-jet-dropdown-link>
                            @endcan

                            <div class="border-t border-gray-100"></div>

                            <!-- Team Switcher -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Switch Teams') }}
                            </div>

                            @foreach (Auth::user()->allTeams() as $team)
                            <x-jet-switchable-team :team="$team" />
                            @endforeach
                        </div>
                    </x-slot>
                </x-jet-dropdown>
            </div>
            @endif

            <!-- Language selector ---->
            <!-- This changes the session('locale') and by the Middleware StoreUserLangPreference this locale 
                is stored as the lang_preference in the user table 
                -->
            <div class="block space-x-2 px-8 py-0 text-xs font-thin hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 transition">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a class="text-gray-900  hover:text-gray-700 focus:text-gray-700 focus:border-gray-300 transition" rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                    @if($localeCode == app()->getLocale())
                    <span class="text-gray-900 font-weight-900">{{ strtoupper($localeCode) }}</span>
                    @else
                    <span class="text-gray-400"> {{ strtoupper($localeCode) }}
                        @endif
                </a>
                @endforeach
            </div>



            <!-- Settings / Profile Dropdown -->
            <div class="bloc  ml-3 py-0 text-s text-grey-500">
                {{ Session('activeProfileName') }}
            </div>

            <div class="ml-2 relative">
                <x-jet-dropdown align="right" width="48">
                    <x-slot name="trigger">

                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <button class="flex text-sm border-1 border-white border-2 shadow-sm rounded-full hover:border-grey-900 focus:border-grey-900 focus:border-gray-300 transition">
                            <img class="h-9 w-9 rounded-full object-cover" src="{{ Storage::url(Session('activeProfilePhoto')) }}" alt="{{ Session('activeProfileName') }}" />
                        </button>
                        @else
                        <span class="inline-flex rounded-md">
                            <button type="button" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                {{ Session('activeProfileName') }}

                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>

                            </button>
                        </span>
                        @endif
                        <span class="badge badge-pill badge-danger mr-n2" id="nav_mobile_total_count"></span>

                    </x-slot>

                    <x-slot name="content">
                    {{-- ?? --}}

                        <!---- Switch Profile --->
                        @if (App\Models\User::with('organizations')->find(Auth::user()->id)->organizations->find(1) != null)
                        <livewire:select-organization>
                            @endif

                            <!---- Edit profile --->
                            @if (session('activeProfileType') == 'App\Models\User')
                            <x-jet-dropdown-link href="{{ route('user.edit') }}" :active="request()->routeIs('user.edit')">
                                {{ __('Edit Profile') }}
                            </x-jet-dropdown-link>
                            @elseif (session('activeProfileType') == 'App\Models\Organization')
                            <x-jet-dropdown-link href="{{ route('org.edit') }}" :active="request()->routeIs('org.show')">
                                {{ __('Edit profile') }}
                            </x-jet-dropdown-link>
                            @endif


                            <!--- Messenger --->
                            <x-jet-dropdown-link href="{{ route('messenger.portal') }}">
                                {{ __('Messages') }} <span class="badge badge-pill badge-danger mr-n2" id="nav_thread_count"></span>
                            </x-jet-dropdown-link>


                            <!--- Messender Friends --->
                            <div id="pending_friends_nav" class="nav-item dropdown block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                <a id="click_friends_tab" href="#" class="dropdown block nav-link pt-1 pb-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onClick="drop()">
                                    {{ __('Friends') }} <span class="badge badge-pill badge-danger mr-n2" id="nav_friends_count"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right notify-drop bg-light" aria-labelledby="click_friends_tab">
                                    <div class="row">
                                        <div class="col-12 pill-tab-nav">
                                            <nav id="nav-friend-tabs" class="nav nav-pills flex-column flex-sm-row" role="tablist">
                                                <a class="flex-sm-fill text-sm-center nav-link h6 active" id="tab-pending" data-toggle="pill" href="#f_pending" role="tab" aria-controls="f_pending" aria-selected="true"><i class="fas fa-user-friends"></i> Pending</a>
                                                <a class="flex-sm-fill text-sm-center nav-link h6" id="tab-sent" data-toggle="pill" href="#f_sent" role="tab" aria-controls="f_sent" aria-selected="false"><i class="fas fa-user-friends"></i> Sent</a>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div id="f_pending" class="tab-pane fade show active">
                                            <div id="pending_friends_ctnr" class="drop-content list-group">
                                                <div class="col-12 text-center">
                                                    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="f_sent" class="tab-pane fade">
                                            <div id="sent_friends_ctnr" class="drop-content list-group">
                                                <div class="col-12 text-center">
                                                    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
            </div>

            <!---- Settings --->
            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Settings') }}
            </x-jet-dropdown-link>


            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                {{ __('API Tokens') }}
            </x-jet-dropdown-link>
            @endif

            <div class="border-t border-gray-200"></div>

            <!-- Log out -->
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </x-jet-dropdown-link>
            </form>
            </x-slot>
            </x-jet-dropdown>
        </div>
    </div>

    <!-- Hamburger -->
    <div class="-mr-2 flex items-center sm:hidden">
        <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>
            <x-jet-responsive-nav-link href="{{ route('transfer') }}" :active="request()->routeIs('transfer')">
                {{ __('Tranfer') }}
            </x-jet-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                <div class="shrink-0 mr-3">
                    <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                {{-- ?? --}}

                    <!---- Switch Profile --->
                    @if (App\Models\User::with('organizations')->find(Auth::user()->id)->organizations->find(1) != null)
                    <livewire:select-organization>
                    @endif

                    <!---- Edit profile --->
                    @if (session('activeProfileType') == 'App\Models\User')
                    <x-jet-dropdown-link href="{{ route('user.edit') }}" :active="request()->routeIs('user.edit')">
                        {{ __('Edit Profile') }}
                    </x-jet-dropdown-link>
                    @elseif (session('activeProfileType') == 'App\Models\Organization')
                    <x-jet-dropdown-link href="{{ route('org.edit') }}" :active="request()->routeIs('org.show')">
                        {{ __('Edit profile') }}
                    </x-jet-dropdown-link>
                    @endif

                            <!--- Messenger --->
                            <x-jet-dropdown-link href="{{ route('messenger.portal') }}">
                                {{ __('Messages') }} <span class="badge badge-pill badge-danger mr-n2" id="nav_thread_count"></span>
                            </x-jet-dropdown-link>


                            <!--- Messender Friends --->
                            <div id="pending_friends_nav" class="nav-item dropdown block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition">
                                <a id="click_friends_tab" href="#" class="dropdown block nav-link pt-1 pb-0" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onClick="drop()">
                                    {{ __('Friends') }} <span class="badge badge-pill badge-danger mr-n2" id="nav_friends_count"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right notify-drop bg-light" aria-labelledby="click_friends_tab">
                                    <div class="row">
                                        <div class="col-12 pill-tab-nav">
                                            <nav id="nav-friend-tabs" class="nav nav-pills flex-column flex-sm-row" role="tablist">
                                                <a class="flex-sm-fill text-sm-center nav-link h6 active" id="tab-pending" data-toggle="pill" href="#f_pending" role="tab" aria-controls="f_pending" aria-selected="true"><i class="fas fa-user-friends"></i> Pending</a>
                                                <a class="flex-sm-fill text-sm-center nav-link h6" id="tab-sent" data-toggle="pill" href="#f_sent" role="tab" aria-controls="f_sent" aria-selected="false"><i class="fas fa-user-friends"></i> Sent</a>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div id="f_pending" class="tab-pane fade show active">
                                            <div id="pending_friends_ctnr" class="drop-content list-group">
                                                <div class="col-12 text-center">
                                                    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="f_sent" class="tab-pane fade">
                                            <div id="sent_friends_ctnr" class="drop-content list-group">
                                                <div class="col-12 text-center">
                                                    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
            </div>

            <!---- Settings --->
            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                {{ __('Settings') }}
            </x-jet-dropdown-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                    {{ __('API Tokens') }}
                </x-jet-responsive-nav-link>
                @endif


                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                <div class="border-t border-gray-200"></div>

                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Manage Team') }}
                </div>

                <!-- Team Settings -->
                <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" :active="request()->routeIs('teams.show')">
                    {{ __('Team Settings') }}
                </x-jet-responsive-nav-link>

                @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                    {{ __('Create New Team') }}
                </x-jet-responsive-nav-link>
                @endcan

                <div class="border-t border-gray-200"></div>

                <!-- Team Switcher -->
                <div class="block px-4 py-2 text-xs text-gray-400">
                    {{ __('Switch Teams') }}
                </div>

                @foreach (Auth::user()->allTeams() as $team)
                <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
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