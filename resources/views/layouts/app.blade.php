<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="title" content="@yield('title', config('messenger-ui.site_name'))">

        <title>@yield('title', config('messenger-ui.site_name'))</title>
        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Scripts -->
        <wireui:scripts />
        <script src="//unpkg.com/alpinejs" defer></script>



        <!-- Fonts -->

        <!-- Styles -->
        @livewireStyles
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link id="main_css" href="{{ asset(mix('app.css', 'vendor/messenger')) }}" rel="stylesheet"> {{--  Needed for Messenger notification pills in nav-bar --}}
        <style>

            /* Friends dropdown navigation bar */
            #messenger-style-overrides #click_friends_tab {padding: 0;}
            #messenger-style-overrides #click_friends_tab {color: initial;}
            #messenger-style-overrides #click_friends_tab:hover {color: initial;}
            #messenger-style-overrides #click_friends_tab:hover {text-decoration: initial;}
            #messenger-style-overrides #nav-friend-tabs {margin: 4px 20px 0px 20px;}
            #messenger-style-overrides .nav-pills .nav-link.active, .nav-pills .show > .nav-link {background-color: #1f2937; color: #fff;}
            #messenger-style-overrides .nav-pills .nav-link.active, .nav-pills .show > .nav-link:hover {background-color: #1f2937; color: #fff;}
            #messenger-style-overrides .pill-tab-nav > .nav-pills > a.active:hover {background-color: #1f2937; color: #fff !important;}
            #messenger-style-overrides .pill-tab-nav > .nav-pills > a:hover {background-color: #e2e6ea; color: #1f2937 !important;}
            #messenger-style-overrides .pill-tab-nav > .nav-pills > a {background-color: #f8f9fa; color: #000; border: 1px #dee2e6 solid;}

            /* Set messenger container to match space viewport */
            #messenger-style-overrides #thread_header_area {position: initial;}
            #messenger-style-overrides .chat-body {max-height: calc(75vh - 180px); margin: 1px 0px 10px 0px; padding: 30px 10px 10px;}
            #messenger-style-overrides #messenger_container {height:75vh; overflow:scroll;}
            #messenger-style-overrides #chat-footer {position:initial;}

            /* Side-bar avators and threads */
            #messenger-style-overrides .avatar-is-offline {box-shadow: 0px 0px 0px 2px #dee2e6; padding:1px}
            #messenger-style-overrides .avatar-is-away{box-shadow: 0px 0px 0px 2px #1f2937; padding:1px}
            #messenger-style-overrides .avatar-is-online {box-shadow: 0px 0px 0px 2px #38c172; padding:1px}
            #messenger-style-overrides .input-group {position:initial;}
            #messenger-style-overrides .messages-panel.card {border: none;}
            #messenger-style-overrides .alert-warning {background: #1f2937; border-color: #000; color: #fff;}
            #messenger-style-overrides .thread_list_item.alert-warning:hover {background: #1f2937 !important; border-color: #000; color: #fff;}
            #messenger-style-overrides .thread_list_item.alert-warning.shadow-sm.rounded a{color: #fff;}
            #messenger-style-overrides .alert-info {background: #fff; border: 0px solid #dfdfdf;padding: 5px 10px;}
            #messenger-style-overrides #messages_ul .thread_list_item.alert-warning.shadow-sm.rounded.alert-info {background: #1f2937;}
            #messenger-style-overrides .inbox ul.messages-list li:hover {background: #f8f9fa;border: 0px solid #dfdfdf;padding: 5px 10px;}
            #messenger-style-overrides .shadow-sm.badge.badge-pill.badge-primary {background: #e3342f; color: #fff;}

            /* Message container header and buttons */
            #messenger-style-overrides #messenger_container .bg-light { background-color: #fff !important;}
            #messenger-style-overrides #message_container .btn.text-danger {color: #212529 !important;}
            #messenger-style-overrides #messenger_container .btn {border-color: #dee2e6}
            #messenger-style-overrides .badge-info {background-color: #d7d9da; color: #1f2937; }

            #messenger-style-overrides .badge-primary {background-color:  #d7d9da;}
            #messenger-style-overrides .spinner-grow {background-color:  #d7d9da;}

            /* Change Font Awesome icons for better user experience */
            #messenger-style-overrides .fa-2x {font-size: 1em; color: #212529 !important;}
            #messenger-style-overrides .fas.fa-cog::before {content: "\f0c9" !important;} /* Bars (Hamburger menu) */
            #messenger-style-overrides .fas.fa-cogs::before {content: "\f4ad" !important;} /* Comment dots (Conversation menu) */
            #messenger-style-overrides .fas.fa-hourglass::before {content: "\f252"!important;} /* Hourglass halfway */
            #messenger-style-overrides .container .fas.fa-edit::before {content: "\f0c0" !important; color: #1f2937;} /* Three profiles (New group conversation) */
            #messenger-style-overrides .container .fas.fa-user-friends::before {content: "\f4fc" !important; color: #1f2937;} /* Profile with check sign (Friends) */
            #messenger-style-overrides .container .fas.fa-cog::before {content: "\f0ad" !important; color: #1f2937;} /* Wrench (Settings) */
            #messenger-style-overrides #click_friends_tab .fa-ban::before {content: "\f057" !important;} /* Circle with x -sign */
            #messenger-style-overrides #pending_friends_nav .fa-ban::before {content: "\f057" !important;} /* Circle with x -sign */

            /* Message bodies */
            #messenger-style-overrides .fa-clock {display: none;}
            #messenger-style-overrides .message-body .message-text {font-size:16px;}
            #messenger-style-overrides .message-body .message-text {font-size:16px;}
            #messenger-style-overrides .message .message-body {border-radius: 6px;}

            /* Left messages (others) */
            #messenger-style-overrides .message.info .message-body {color: #263238;background: #d7d9da; rotate: z -0.0deg;}
            /* Right messages (self) */
            #messenger-style-overrides .my-message .message-body {color: #fff;background: #808080; rotate: z -0.0deg;}
            #messenger-style-overrides .my-message .timeago {color: #fff;background: #808080;}
            #messenger-style-overrides .my-message a {color: #fff;background: #808080;}
            #messenger-style-overrides .my-message a:hover {color: #d7d9da; background: #808080;}
            #messenger-style-overrides .message.my-message::after {display: none;}

            /* Message reactions */
            #messenger-style-overrides #message_container .message-reactions .reactions-body .reacted-by-me {box-shadow: 0 0 0px 1px #dee2e6}
            #messenger-style-overrides #message_container .message-reactions .text-primary {color: #d7d9da !important}

            /* Message container avatars */
            #messenger-style-overrides #thread_header_area img {height: 50px; width:50px;}
            #messenger-style-overrides img.bobble-image {height: 30px; width:30px;}
            #messenger-style-overrides img.main-bobble-offline {box-shadow: 0px 0px 0px 2px #dee2e6; padding:1px}
            #messenger-style-overrides img.main-bobble-away{box-shadow: 0px 0px 0px 2px #1f2937; padding:1px}
            #messenger-style-overrides img.main-bobble-online {box-shadow: 0px 0px 0px 2px #38c172; padding:1px}
            #messenger-style-overrides #message_container .message-avatar {display:none}
            #messenger-style-overrides #message_container .message::before {border:0px;}

            /* Message footer and input field */
            #messenger-style-overrides .form-control:focus {border-color: #1f2937; box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 0 .2rem rgba(194, 194, 194, 0.25);}
            #messenger-style-overrides .messages-panel .chat-footer .card.bg-light.mb-0.border-0 {background-color: #fff !important;}
            #messenger-style-overrides #thread_form .btn {margin-top:10px;}

            /* Modals like editing a message */
            #messenger-style-overrides .bg-gradient-dark {background: #fff!important; color:#1f2937 !important;}
            #messenger-style-overrides .bg-gradient-primary {background: #fff!important; color:#1f2937 !important;}
            #messenger-style-overrides .bg-gradient-danger {background: #fff!important; color:#1f2937 !important;}
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
                 background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x !important;
                 border-color: #dae0e5;
                 color: #212529;
                 box-shadow:none !important;}
            #messenger-style-overrides #message_container .btn-primary:active, .btn-outline-primary:active, .btn-info:active, .btn-outline-info:active, .btn-dark:active, .btn-outline-dark:active {
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides #message_container .btn-primary:hover, .btn-outline-primary:hover, .btn-info:hover, .btn-outline-info:hover, .btn-dark:hover, .btn-outline-dark:hover {
                background: #e2e6ea linear-gradient(180deg,#e5e9ed,#e2e6ea) repeat-x !important;
                border-color: #dae0e5;
                color: #212529;}
            #messenger-style-overrides #message_container .btn-primary, .btn-outline-primary, .btn-info, .btn-outline-info, .btn-dark, .btn-outline-dark {                background: #f8f9fa linear-gradient(180deg,#f8f9fa,#f8f9fa) repeat-x;
                border-color: #f8f9fa;
                box-shadow: inset 0 1px 0 hsla(0,0%,100%,.15),0 1px 1px rgba(0,0,0,.075);
                color: #212529;}
            #messenger-style-overrides #message_container .bg-warning, .bg-outline-warning {background: #1f2937!important;color:#fff;}

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
                color:  #d7d9da;
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

            /* Overall Messenger styles */
            #messenger-style-overrides .text-info {color: #1f2937 !important}
            #messenger-style-overrides b, strong {font-weight: lighter;}
            #messenger-style-overrides .badge {font-weight: 500;}
            #messenger-style-overrides .text-success {color: #1f2937 !important;}


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
        {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
              {{-- Broadcast test! --}}

        @livewireScripts
        @stack('modals')
        @include('messenger::scripts')

        <script>
        console.log('app.blade');
            window.Pusher.logToConsole = true;
            window.Echo.private('switchProfile')
                .listen('ProfileSwitchEvent', (e) => {
                    window.location.reload();
                });

        </script>


    </body>
</html>
