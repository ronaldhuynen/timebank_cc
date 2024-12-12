<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    <wireui:scripts />
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
 <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom_timebank.css') }}" rel="stylesheet">
    @livewireStyles
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}"> --}}
</head>
<body>
    <x-jetstream.banner />
    <x-jetstream.toaster />
    <x-notifications position="bottom-end" />
    <div class="min-h-screen bg-gray-100">
       @livewire('navigation-menu-guest')
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-footer />
    </div>

    <!-- Scripts body-->
    <!-- Be careful with changing the loading order! -->
    @livewireScripts
    <script src="{{ asset('js/app.js') }}" defer></script>
    @stack('scripts')
    @yield('scripts_body')
    @yield('js')
</body>
</html>