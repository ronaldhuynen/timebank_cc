<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="@yield('title', config('messenger-ui.site_name'))">

        <title>@yield('title', config('messenger-ui.site_name'))</title>

        <!-- Scripts head -->
        <wireui:scripts />
        <script src="{{ asset('js/app.js') }}" defer></script>



        <!-- Fonts -->

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link id="main_css" href="{{ asset(mix('app.css', 'vendor/messenger')) }}" rel="stylesheet"> {{--  Needed for Messenger notification pills in nav-bar --}}
        <link rel="stylesheet" href="{{ asset('css/custom_messenger.css') }}">
        <link rel="stylesheet" href="{{ asset('css/trix.css') }}">
        <link rel="stylesheet" href="{{ asset('css/filepond.min.css') }}">
        <link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>

        <style>

            input[type=file]::file-selector-button {
                border-style: none;
                padding: 0;
                color: #fff !important;
                padding-left: 1.0rem;
                padding-top: 0.25rem;
                padding-right: 1.0rem;
                padding-bottom: 0.25rem;
                border-radius: 0.25rem;
                -webkit-appearance: button;
                font-weight: 700;
                --tw-bg-opacity: 1;
                background-color: rgb(107 114 128 / var(--tw-bg-opacity));
            	text-transform: none;
            }

            input[type=file]::file-selector-button:hover {
            cursor: pointer;
            --tw-text-opacity: 1;
            --tw-bg-opacity: 1;
            background-color: rgb(107 114 128 / var(--tw-bg-opacity));
            }

            progress {
                width: 100%;
                height: 20px;
                border: none;
                background-color: #f1f1f1;
            }

            progress::-webkit-progress-bar {
                background-color: #f1f1f1;
            }

            progress::-webkit-progress-value {
                background-color: #9ae6b4;
            }

            progress::-moz-progress-bar {
                background-color: #9ae6b4;
            }


        </style>

    </head>
    <body class="font-sans antialiased" id="messenger-style-overrides">

        <x-jet-banner />
        <x-jet-toaster />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Scripts body-->
        <script src="{{ mix('js/echo.js') }}"></script>
        @livewireScripts
        {{-- @fcScripts  Form Components by rawilk/laravel-form-components use after @livewireScripts --}}
        <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
        <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
        @stack('modals')
        {{-- @stack('scripts') --}}
        @yield('scripts_body')
        @include('messenger::scripts')



{{-- @yield('js') --}}



        <!-- ProfileSwitchEvent --->
        {{-- <script>
        console.log('Inside app.blade.php');
            window.Pusher.logToConsole = false;
            window.Echo.private('switch-profile.{{ auth()->id() }}')
                .listen('ProfileSwitchEvent', (e) => {
                    console.log('ProfileSwitchEvent received.');
                    console.log(e);
                  });
        </script> --}}


    </body>
</html>
