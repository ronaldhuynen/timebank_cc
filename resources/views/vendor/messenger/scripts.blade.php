<!--- Load Messenger script ---->
<script src="{{ asset(mix('app.js', 'vendor/messenger')) }}"></script>
<script> console.log('messenger scripts in vendor/messenger/app.js are loaded') </script>
@stack('js')
@if(auth()->check())
@endif
<script>
@if(auth()->check())
    Messenger.init({
        load : {
            NotifyManager : {
                notify_sound : {{messenger()->getProviderMessenger()->notify_sound ? 'true' : 'false'}},
                message_popups : {{messenger()->getProviderMessenger()->message_popups ? 'true' : 'false'}},
                message_sound : {{messenger()->getProviderMessenger()->message_sound ? 'true' : 'false'}},
                call_ringtone_sound : {{messenger()->getProviderMessenger()->call_ringtone_sound ? 'true' : 'false'}},
                src : 'NotifyManager.js'
            },
@stack('Messenger-load')

        },
        provider : {
            @if(config('messenger.provider_uuids'))
                id : '{{messenger()->getProvider()->getKey()}}',
            @else
                id : {{messenger()->getProvider()->getKey()}},
            @endif
            model : '{{messenger()->getProvider()->getMorphClass()}}',
            alias : '{{messenger()->getProviderAlias()}}',
            name : '{{ messenger()->getProvider()->getProviderName()}}',
            slug : '{{ messenger()->getProvider()->getProviderAvatarRoute('sm')}}',
            avatar_md : '{{ messenger()->getProvider()->getProviderAvatarRoute('md')}}',
            avatar_sm : '{{ messenger()->getProvider()->getProviderAvatarRoute('sm')}}',
        },
        common : {
            app_name : '{{config('messenger-ui.site_name')}}',
            api_endpoint : '{{messenger()->getApiEndpoint()}}',
            web_endpoint : '{{'/'.config('messenger-ui.routing.prefix')}}',
            socket_endpoint : '{{config('messenger-ui.websocket.host')}}',
            socket_auth_endpoint : '{{config('messenger-ui.websocket.auth_endpoint')}}',
            socket_key : '{{config('messenger-ui.websocket.key')}}',
            socket_port : {{config('messenger-ui.websocket.port')}},
            socket_tls : {{config('messenger-ui.websocket.use_tsl') ? 'true' : 'false'}},
            socket_cluster : '{{config('messenger-ui.websocket.cluster')}}',
            socket_pusher : {{config('messenger-ui.websocket.pusher') ? 'true' : 'false'}},
            base_css : '{{ asset(mix('app.css', 'vendor/messenger')) }}',
            dark_css : '{{ asset(mix('dark.css', 'vendor/messenger')) }}',
            dark_mode : {{messenger()->getProviderMessenger()->dark_mode ? 'true' :  'false'}},
            mobile : false,
        },
        modules : {
@stack('Messenger-modules')

        },
@stack('Messenger-call')
}, '{{config('app.env')}}');
@else
    Messenger.init({
        load : {
        @stack('Messenger-load')
        },
        common : {
            app_name : '{{config('messenger-ui.site_name')}}',
            api_endpoint : '{{messenger()->getApiEndpoint()}}',
            web_endpoint : '{{'/'.config('messenger-ui.routing.prefix')}}',
            socket_endpoint : '{{config('messenger-ui.socket_endpoint')}}',
            base_css : '{{ asset(mix('app.css', 'resources/css/messenger')) }}',
            dark_css : '{{ asset(mix('dark.css', 'resources/css/messenger')) }}',

            dark_mode : false,
            mobile : false,
        },
        modules : {
        @stack('Messenger-modules')
        },
        @stack('Messenger-call')
    }, '{{config('app.env')}}');
@endif
</script>
@stack('special-js')