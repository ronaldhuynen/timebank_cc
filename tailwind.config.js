const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors');

/** @type {import('tailwindcss').Config} */
module.exports = {
    // mode: 'jit',
    // purge: [
    //     './public/**/*.html',
    //     './src/**/*.{js,jsx,ts,tsx,vue}',
    //     "./vendor/robsontenorio/mary/src/View/Components/**/*.php"
    // ],
    presets: [
        require('./vendor/wireui/wireui/tailwind.config.js')
    ],
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // './vendor/wireui/wireui/resources/**/*.blade.php',  // Wire UI livewire components
        // './vendor/wireui/wireui/ts/**/*.ts',                // Wire UI livewire components
        // './vendor/wireui/wireui/src/View/**/*.php',          // Wire UI livewire components

        "./vendor/wireui/wireui/src/*.php",
        "./vendor/wireui/wireui/ts/**/*.ts",
        "./vendor/wireui/wireui/src/WireUi/**/*.php",
        "./vendor/wireui/wireui/src/Components/**/*.php",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#F6F8F9',
                    100: '#EBEDEE',
                    200: '#DCDEDF',
                    300: '#CDCFD0',
                    400: '#B8BABB',
                    500: '#999B9C',
                    600: '#6E6F70',
                    700: '#434343',
                    800: '#242424',
                    900: '#1A1A1A',
                },
                secondary: colors.gray,
                positive: colors.gray,
                negative: colors.red,
                warning: colors.amber,
                info: colors.gray
            },
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('daisyui')
    ],
};