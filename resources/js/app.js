require('./bootstrap');

import Trix from "trix";
import { createPopper } from "@popperjs/core";
import focus from "@alpinejs/focus";
import tagifyMin from "@yaireo/tagify";

Alpine.plugin(focus);

window.createPopper = createPopper;
window.Tagify = tagifyMin;      // Needs to be loaded after Alpine



