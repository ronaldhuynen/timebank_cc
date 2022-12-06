<html>
    <head>
    </head>
    <body>
        <div>
            Dispatch 'php artisan user:lang' command to execute Test_UserLangChangedEvent, that will be broadcasts on private channel 'change-lang.{{ $toUserId }}':<br>{{ $user->name }}'s locale setting is <strong id="lang">{{ $user->locale }}.</strong><br/>
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            window.Pusher.logToConsole = true;
            window.Echo.private('change-lang.{{ $toUserId }}')
                .listen('Test_UserLangChangedEvent', (e) => {
                    console.log(e);
                    document.getElementById('lang').innerHTML = e.user.locale;
                    });
        </script>
    </body>
</html>