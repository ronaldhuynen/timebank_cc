require('./bootstrap');
require('alpinejs');


import Alpine from 'alpinejs';
import { createPopper } from "@popperjs/core";
import Trix from "trix";
document.addEventListener("trix-before-initialize", () => {
  // Change Trix.config if you need
})

window.Alpine = Alpine;

Alpine.start();
window.createPopper = createPopper;



