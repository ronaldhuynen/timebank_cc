<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Test</title>
</head>

    <body>
        <div>
            Private channel 'private-change-lang.{{ $toUserId }}':<br>{{ $user->name }}'s locale setting is <strong id="lang">{{ $user->locale }}.</strong><br />
        </div>

        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            window.Laravel = {'csrfToken': '{{csrf_token()}}'}
            window.Pusher.logToConsole = true;
            window.Echo.private('private-change-lang.{{ $toUserId }}')
                .listen('Test_UserLangChangedEventPrivate', (e) => {
                    console.log(e);
                    document.getElementById('lang').innerHTML = e.user.locale;
                });

        </script>

    </body>
</html>