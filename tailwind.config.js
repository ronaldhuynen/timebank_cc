const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    // mode: 'jit',
    // purge: [
    //     './public/**/*.html',
    //     './src/**/*.{js,jsx,ts,tsx,vue}'],
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './vendor/wireui/wireui/resources/**/*.blade.php',  // Wire UI livewire components
        './vendor/wireui/wireui/ts/**/*.ts',                // Wire UI livewire components
        './vendor/wireui/wireui/src/View/**/*.php'          // Wire UI livewire components
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
    },

    plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')],
};
