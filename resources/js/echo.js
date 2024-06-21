
/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */


import Echo from 'laravel-echo';

window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: process.env.MIX_REVERB_APP_KEY,
    wsHost: process.env.MIX_REVERB_HOST,
    wsPort: process.env.MIX_REVERB_PORT ?? 80,
    wssPort: process.env.MIX_REVERB_PORT ?? 433,
    wsPath: process.env.MIX_REVERB_PATH ?? "/",
    forceTLS: (process.env.MIX_REVERB_SCHEME ?? "https") === "https",
    enabledTransports: ['ws', 'wss'],
});


