<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Debug 1</title>
</head>

<body>

    <ul>
        @foreach ([
        ['name' => 'Debug 1', 'url' => route('debug-1')],
        ['name' => 'Test ip location', 'url' => route('ip-location')],
        ['name' => 'Web Tinker', 'url' => '/test/tinker'], // Direct path added here
        ['name' => 'Clear Cache', 'url' => route('clear-cache')],
        ['name' => 'Optimize Clear', 'url' => route('optimize-clear')],
    ] as $link)
            <li><a href="{{ $link['url'] }}">{{ $link['name'] }}</a></li>
        @endforeach
    </ul>

    <hr />

    <div>
        {{ phpinfo() }}
        {{ xdebug_info() }}
    </div>

</body>

</html>
