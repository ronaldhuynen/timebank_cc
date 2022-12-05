// const { default: Echo } = require('laravel-echo');

require('./bootstrap');

// let echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     wshost: window.location.hostname,
//     wsPort: 6001,
//     forceTLS: false,
//     disableStats: true,
//     enabledTransports: ['ws', 'wss']
// });


import Alpine from 'alpinejs';
import { createPopper } from "@popperjs/core";

window.Alpine = Alpine;

Alpine.start();
window.createPopper = createPopper;



