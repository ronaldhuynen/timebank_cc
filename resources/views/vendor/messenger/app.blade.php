<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> --}}
        {{-- <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> --}}
        {{-- <meta name="mobile-web-app-capable" content="yes"> --}}
        {{-- <meta name="apple-mobile-web-app-capable" content="yes"> --}}
        {{-- <meta name="application-name" content="FS"> --}}
        {{-- <meta name="apple-mobile-web-app-title" content="FS"> --}}
        {{-- <meta name="theme-color" content="#343a40"> --}}
        {{-- <meta name="msapplication-navbutton-color" content="#343a40"> --}}
        {{-- <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"> --}}
        {{-- <meta name="msapplication-starturl" content="/"> --}}
        {{-- <link rel="icon" type="image/png" sizes="192x192" href="{{asset('vendor/messenger/images/android-chrome-192x192.png')}}"> --}}
        {{-- <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="{{asset('vendor/messenger/images/apple-touch-icon.png')}}"> --}}
        {{-- <link rel="icon" type="image/png" sizes="32x32" href="{{asset('vendor/messenger/images/favicon-32x32.png')}}"> --}}
        {{-- <link rel="icon" type="image/png" sizes="16x16" href="{{asset('vendor/messenger/images/favicon-16x16.png')}}"> --}}
        {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
        <meta name="title" content="@yield('title', config('messenger-ui.site_name'))">
        <title>@yield('title', config('messenger-ui.site_name'))</title>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> <!-- TODO replace with own hosted font --> --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css"> <!-- Needed for Messenger icons. TODO replace with self hosted css -->

        <!-- Styles -->
        @livewireStyles
        {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
        @auth
        <link id="main_css" href="{{ asset(mix(messenger()->getProviderMessenger()->dark_mode ? 'dark.css' : 'app.css', 'vendor/messenger')) }}" rel="stylesheet">
        @else
        <link id="main_css" href="{{ asset(mix('dark.css', 'vendor/messenger')) }}" rel="stylesheet">
        @endauth

        {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
        {{-- @stack('css') --}}

        <!-- Scripts -->
        {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}

    </head>

    <body class="font-sans antialiased">
        <x-jet-banner />
        <x-jet-toaster />

        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                    {{ __('Chat Messenger') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white  shadow-xl sm:rounded-lg">
                        @yield('content')
                    </div>
                </div>
            </div>
        </x-app-layout>

    </body>
</html>
