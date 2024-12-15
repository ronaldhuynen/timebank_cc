const mix = require('laravel-mix');

mix.setResourceRoot('../');

mix.js('resources/js/echo.js', 'public/js')
    .js('node_modules/@yaireo/tagify/dist/tagify.js', 'public/js')
    .js('node_modules/@yaireo/tagify/dist/tagify.polyfills.min.js', 'public/js')
    .js('resources/js/skilltags.js', 'public/js/skilltags.js')
    .js('resources/js/app.js', 'public/js')

    .sass('resources/sass/app.scss', 'public/css/app.css')
    .sass('node_modules/@yaireo/tagify/src/tagify.scss', 'public/css/tagify.css')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .postCss('resources/sass/custom_messenger.css', 'public/css/custom_messenger.css')
    .postCss('resources/sass/custom_tagify.css', 'public/css/custom_tagify.css')
    .postCss('resources/sass/custom_timebank.css', 'public/css/custom_timebank.css')
    .postCss('resources/css/fonts.css', 'public/css/fonts.css') // Add this line to process fonts.css
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .copyDirectory('resources/fonts', 'public/fonts') // Add this line to copy the fonts directory
    .sourceMaps()
    .version()
    .autoload({ 'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery", 'global.jQuery', "global.$"] });