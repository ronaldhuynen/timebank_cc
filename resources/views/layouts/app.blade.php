<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link id="main_css" href="{{ asset(mix('app.css', 'vendor/messenger')) }}" rel="stylesheet"> {{--  Needed for Messenger notification pills in nav-bar --}}
        <style>

            /* Set messenger container to match space viewport */
            #messenger-style-overrides #thread_header_area {position: initial;}
            #messenger-style-overrides .chat-body {max-height: calc(75vh - 180px); margin: 1xpx 0px 10px 0px; padding: 30px 10px 10px;}
            #messenger-style-overrides #messenger_container {height:75vh; overflow:scroll;}
            #messenger-style-overrides #chat-footer {position:initial;}

            /* Side-bar avators */
            #messenger-style-overrides .avatar-is-offline {box-shadow: 0px 0px 0px 2px #dee2e6; padding:1px}
            #messenger-style-overrides .avator-is-away{box-shadow: 0px 0px 0px 2px #000; padding:1px}
            #messenger-style-overrides .avatar-is-online {box-shadow: 0px 0px 0px 2px #38c172; padding:1px}

            #messenger-style-overrides .messages-panel.card {border: none;}

            /* Message container header and buttons */
            #messenger-style-overrides #messenger_container .bg-light { background-color: #fff !important;
}
            #messenger-style-overrides #message_container .btn.text-danger {color: #212529 !important;}
            #messenger-style-overrides #messenger_container .btn {border-color: #dee2e6}
            #messenger-style-overrides .badge-info {background-color: grey;}
            #messenger-style-overrides .spinner-grow {color: grey; !important}

            /* Change Font Awesome icons for better user experience */
            #messenger-style-overrides .fa-2x {font-size: 1em; color: #212529 !important;}
            #messenger-style-overrides .fas.fa-cog::before {content: "\f0c9" !important;}
            #messenger-style-overrides .fas.fa-cogs::before {content: "\f4ad" !important;}

            /* Message bubbles */
            #messenger-style-overrides .messages-panel .fa-clock {display: none;}
            #messenger-style-overrides .message-body .message-text {font-size:16px;}

            /* Bubble reactions */
            #messenger-style-overrides #message_container .message-reactions .reactions-body .reacted-by-me {box-shadow: 0 0 0px 1px #dee2e6}
            #messenger-style-overrides #message_container .message-reactions .text-primary {color:grey !important}

            /* Message container avatars */
            #messenger-style-overrides img {height: 50px; width:50px;z-index:50;}
            #messenger-style-overrides img.main-bobble-offline {box-shadow: 0px 0px 0px 2px #dee2e6; padding:1px}
            #messenger-style-overrides img.main-bobble-away{box-shadow: 0px 0px 0px 2px #000; padding:1px}
            #messenger-style-overrides img.main-bobble-online {box-shadow: 0px 0px 0px 2px #38c172; padding:1px}
            #messenger-style-overrides #message_container .message-avatar {display:none}
            #messenger-style-overrides #message_container .message::before {border:0px;}

            /* Message footer and input field */
            #messenger-style-overrides .form-control:focus {border-color: #000; box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 0 .2rem rgba(194, 194, 194, 0.25);}
            #messenger-style-overrides .messages-panel .chat-footer .card.bg-light.mb-0.border-0 {background-color: #fff !important;}



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
        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        @livewireScripts
        @stack('modals')
        @include('messenger::scripts')

    </body>
</html>
