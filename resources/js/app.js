// console.log('app.js is loaded');

require('./bootstrap');


import Alpine from 'alpinejs';
import { createPopper } from "@popperjs/core";

window.Alpine = Alpine;

Alpine.start();
window.createPopper = createPopper;



