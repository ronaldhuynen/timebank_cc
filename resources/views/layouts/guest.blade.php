<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="@yield('title', config('messenger-ui.site_name'))">

        <title>@yield('title', config('messenger-ui.site_name'))</title>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        <wireui:scripts />
        <script src="{{ mix('js/app.js') }}" defer></script>
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    </head>
    <body>
        <x-banner />
        <x-toaster />
        <x-notifications />

        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>


         <!-- Scripts -->
         <script src="{{ mix('js/echo.js') }}"></script>
         @livewireScripts

    </body>
</html>
