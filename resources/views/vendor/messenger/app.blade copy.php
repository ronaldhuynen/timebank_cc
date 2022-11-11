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
    {{-- <meta name="title" content="@yield('title', config('messenger-ui.site_name'))"> --}}
    {{-- <title>@yield('title', config('messenger-ui.site_name'))</title> --}}
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.1/css/all.min.css"> <!-- Needed for Messenger icons -->

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

    {{-- <div class="min-h-screen bg-gray-100">
        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
    </div>
    </header>
    @endif --}}

    <!-- Page Content -->
        {{-- <wrapper class="d-flex flex-column"> --}}

        {{-- <nav id="FS_navbar" class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="{{url('/')}}">
        <img src="{{ asset('vendor/messenger/images/messenger.png') }}" width="30" height="30" class="d-inline-block align-top" alt="Messenger">
        {{config('messenger-ui.site_name')}}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            <span class="badge badge-pill badge-danger mr-n2" id="nav_mobile_total_count"></span>
        </button>
        <div id="navbarNavDropdown" class="navbar-collapse collapse">
            @auth
            @include('messenger::nav')
            @endauth
        </div>
        </nav> --}}


        {{-- <wrapper class="d-flex flex-column"> --}}
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Chat Messenger') }}
                </h2>
            </x-slot>
            {{-- <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8"> --}}

            <div class="py-12">


                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

                    <div class="bg-white  shadow-xl sm:rounded-lg">

                        @yield('content')
                    </div>
                </div>
            </div>

    </main>
    {{-- </div> --}}
    </x-app-layout>

    {{-- </wrapper> --}}
</body>
</html>

