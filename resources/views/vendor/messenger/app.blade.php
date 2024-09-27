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

        <!-- Styles -->
        @livewireStyles
     

    </head>

    <body class="font-sans antialiased">
        <x-jetstream.banner />
        <x-jetstream.toaster />

        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-900 leading-tight">
                    {{ __('Chat Messenger') }}
                </h2>
            </x-slot>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white  shadow-xl sm:rounded-lg id="messenger-content">
                        @yield('content')
                    </div>
                </div>
            </div>
        </x-app-layout>
    </body>
</html>
