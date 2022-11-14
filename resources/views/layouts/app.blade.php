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
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link id="main_css" href="{{ asset(mix('app.css', 'vendor/messenger')) }}" rel="stylesheet"> {{--  Needed for Messenger notification pills in nav-bar --}}
        <style>

            /* Set messenger container to match space viewport */
            #messenger-style-overrides #thread_header_area {position: initial;}
            #messenger-style-overrides .chat-body {max-height: calc(75vh - 180px); margin: 1px 0px 10px 0px; padding: 30px 10px 10px;}
            #messenger-style-overrides #messenger_container {height:75vh; overflow:scroll;}
            #messenger-style-overrides #chat-footer {position:initial;}

            /* Side-bar avators */
            #messenger-style-overrides .avatar-is-offline {box-shadow: 0px 0px 0px 2px #dee2e6; padding:1px}
            #messenger-style-overrides .avatar-is-away{box-shadow: 0px 0px 0px 2px #000; padding:1px}
            #messenger-style-overrides .avatar-is-online {box-shadow: 0px 0px 0px 2px #38c172; padding:1px}
            #messenger-style-overrides .input-group {position:initial;}

            #messenger-style-overrides .messages-panel.card {border: none;}

            /* Message container header and buttons */
            #messenger-style-overrides #messenger_container .bg-light { background-color: #fff !important;}
            #messenger-style-overrides #message_container .btn.text-danger {color: #212529 !important;}
            #messenger-style-overrides #messenger_container .btn {border-color: #dee2e6}
            #messenger-style-overrides .badge-info {background-color: grey;}
            #messenger-style-overrides .badge-primary {background-color: grey;}
            #messenger-style-overrides .spinner-grow {background-color: grey;}

            /* Change Font Awesome icons for better user experience */
            #messenger-style-overrides .fa-2x {font-size: 1em; color: #212529 !important;}
            #messenger-style-overrides .fas.fa-cog::before {content: "\f0c9" !important;} /* Bars (Hamburger menu) */
            #messenger-style-overrides .fas.fa-cogs::before {content: "\f4ad" !important;} /* Comment dots (Conversation menu) */
            #messenger-style-overrides .container .fas.fa-search::before {content: "\f500" !important; color: #000;} /* Two profiles (Search profile) */
            #messenger-style-overrides .container .fas.fa-edit::before {content: "\f0c0" !important; color: #000;} /* Three profiles (New group conversation) */
            #messenger-style-overrides .container .fas.fa-user-friends::before {content: "\f4fc" !important; color: #000;} /* Profile with check sign (Friends) */
            #messenger-style-overrides .container .fas.fa-cog::before {content: "\f0ad" !important; color: #000;} /* Wrench (Settings) */

            /* Message bubbles */
            #messenger-style-overrides .messages-panel .fa-clock {display: none;}
            #messenger-style-overrides .message-body .message-text {font-size:16px;}

            /* Bubble reactions */
            #messenger-style-overrides #message_container .message-reactions .reactions-body .reacted-by-me {box-shadow: 0 0 0px 1px #dee2e6}
            #messenger-style-overrides #message_container .message-reactions .text-primary {color:grey !important}

            /* Message container avatars */
            #messenger-style-overrides #thread_header_area img {height: 50px; width:50px;}
            #messenger-style-overrides img.bobble-image {height: 30px; width:30px;}
            #messenger-style-overrides img.main-bobble-offline {box-shadow: 0px 0px 0px 2px #dee2e6; padding:1px}
            #messenger-style-overrides img.main-bobble-away{box-shadow: 0px 0px 0px 2px #000; padding:1px}
            #messenger-style-overrides img.main-bobble-online {box-shadow: 0px 0px 0px 2px #38c172; padding:1px}
            #messenger-style-overrides #message_container .message-avatar {display:none}
            #messenger-style-overrides #message_container .message::before {border:0px;}

            /* Message footer and input field */
            #messenger-style-overrides .form-control:focus {border-color: #000; box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 0 .2rem rgba(194, 194, 194, 0.25);}
            #messenger-style-overrides .messages-panel .chat-footer .card.bg-light.mb-0.border-0 {background-color: #fff !important;}
            #messenger-style-overrides #thread_form .btn {margin-top:10px;}

            /* Modals like editing a message */
            #messenger-style-overrides .bg-gradient-dark {background: #fff!important; color:#000 !important;}
            #messenger-style-overrides .bg-gradient-primary {background: #fff!important; color:#000 !important;}
            #messenger-style-overrides .bg-gradient-danger {background: #fff!important; color:#000 !important;}
            #messenger-style-overrides #body_modal .bg-light {background-color: #fff !important; }
            #messenger-style-overrides #body_modal .shadow-sm {box-shadow:0 0 0 rgba(0,0,0,0) !important;}

            #messenger-style-overrides #message_container .btn-success:focus, .btn-outline-success:focus{
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides #message_container .btn-success:hover, .btn-outline-success:hover {
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides #message_container .btn-success, .btn-outline-success{
                background: #f8f9fa linear-gradient(180deg,#f8f9fa,#f8f9fa) repeat-x;
                border-color: #f8f9fa;
                box-shadow: inset 0 1px 0 hsla(0,0%,100%,.15),0 1px 1px rgba(0,0,0,.075);
                color: #212529;}
            #messenger-style-overrides #message_container .btn-primary:focus, .btn-outline-primary:focus, .btn-info:focus, .btn-outline-info:focus, .btn-dark:focus, .btn-outline-dark:focus {
                 background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                 border-color: #dae0e5;
                 color: #212529;}
            #messenger-style-overrides #message_container .btn-primary:hover, .btn-outline-primary:hover, .btn-info:hover, .btn-outline-info:hover, .btn-dark:hover, .btn-outline-dark:hover {
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides #message_container .btn-primary, .btn-outline-primary, .btn-info, .btn-outline-info, .btn-dark, .btn-outline-dark {                background: #f8f9fa linear-gradient(180deg,#f8f9fa,#f8f9fa) repeat-x;
                border-color: #f8f9fa;
                box-shadow: inset 0 1px 0 hsla(0,0%,100%,.15),0 1px 1px rgba(0,0,0,.075);
                color: #212529;}
            #messenger-style-overrides #message_container .bg-warning, .bg-outline-warning {background: #000!important;color:#fff;}

            /* Settings modal*/
            #messenger-style-overrides .switch input:checked + label::before {background-color:#38c172;}
            #messenger-style-overrides #online_status_switch .glowing_btn {animation:none;}
            #messenger-style-overrides #online_status_switch .btn-success {background: #38c172; border-color: #808080; color: #fff;}
            #messenger-style-overrides #online_status_switch .btn-danger {
                background: #333333;
                border-color: #808080;
                color: #fff;
                }
            #messenger-style-overrides #online_status_switch .btn-secondary {
                background: #dee2e6;
                border-color: #808080;
                color: grey;
                }
            #messenger-style-overrides #online_status_switch .btn:not(:disabled):not(.disabled).active {box-shadow: inset 0px 6px 0px rgb(255, 255, 255) ;}

            #messenger-style-overrides .modal-footer .btn-success:focus, .btn-outline-success:focus{
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides .modal-footer .btn-success:hover, .btn-outline-success:hover {
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides .modal-footer .btn-success, .btn-outline-success{
                background: #f8f9fa linear-gradient(180deg,#f8f9fa,#f8f9fa) repeat-x;
                border-color: #f8f9fa;
                box-shadow: inset 0 1px 0 hsla(0,0%,100%,.15),0 1px 1px rgba(0,0,0,.075);
                color: #212529;}

            #messenger-style-overrides #body_modal div.col-6:nth-child(2) {display:none;} /* Remove avatar change and remove options */
            #messenger-style-overrides #main_modal span.h5:nth-child(1) > i:nth-child(1) {display:none;} /* Remove modal title bar icon */

            /* Overall Messnger styles */
            #messenger-style-overrides .text-info {color: #000 !important}

















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
