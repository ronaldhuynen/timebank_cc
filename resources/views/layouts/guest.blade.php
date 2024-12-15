<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <!-- Scripts -->
    <wireui:scripts />
    {{-- <script src="{{ mix('js/app.js') }}" defer></script> --}}
 <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    
    <link href="{{ asset('css/custom_timebank.css') }}" rel="stylesheet">
    <link href="{{ asset('css/fonts.css') }}" rel="stylesheet"> <!-- Include custom fonts CSS -->
    @livewireStyles

    <style>
/* Apply the Roboto font-family to the body */
body {
    font-family: 'Roboto', sans-serif !important;
}

/* Apply the font-family to all heading elements */
h1, h2, h3, h4, h5, h6 {
    font-family: 'Oswald', sans-serif !important;
        text-transform: uppercase !important;
}
    </style>

</head>
<body class="font-sans antialiased flex flex-col min-h-screen">
    <x-jetstream.banner />
    <x-jetstream.toaster />
    <x-notifications position="bottom-end" />
    
    <div class="flex-grow bg-gray-100">
       @livewire('navigation-menu-guest')
        @if (isset($header))
            <header class="bg-black shadow mt-16">
                <div class="max-w-7xl mx-auto pt-1 pb-2 px-4 sm:px-6 lg:px-8 invert-100">
                    {{ $header }}
                </div>
            </header>
        @endif

        <main>
            {{ $slot }}
        </main>
    </div>

     <!-- Footer -->
    <div class="w-full">
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