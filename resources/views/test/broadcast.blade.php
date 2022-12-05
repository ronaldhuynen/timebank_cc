<html>
    <head>
    </head>
    <body>
        <div>
            Public channel 'change-lang':<br>{{ $user->name }}'s locale setting is <strong id="lang">{{ $user->locale }}.</strong><br/>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            window.Pusher.logToConsole = true;
            window.Echo.channel('change-lang')
                .listen('Test_UserLangChangedEvent', (e) => {
                    console.log(e);
                    document.getElementById('lang').innerHTML = e.user.locale;
                    });
        </script>
    </body>
</html>