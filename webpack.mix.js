const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.setPublicPath('public');
mix.setResourceRoot('../');

mix.js('resources/js/echo.js', 'public/js')
    .js('node_modules/@yaireo/tagify/dist/tagify.js', 'public/js')
    .js('node_modules/@yaireo/tagify/dist/tagify.polyfills.min.js', 'public/js')
    .js('resources/js/app.js', 'public/js')
    
    // re-compile the assets of the messenger-ui folder
    // .js('vendor/rtippin/messenger-ui/resources/js/**/*.js', 'vendor/rtippin/messenger-ui/public/js/app.js')

    .sass('resources/sass/app.scss', 'public/css/app.css')
    .sass('node_modules/@yaireo/tagify/src/tagify.scss', 'public/css/tagify.css')
    .postCss('resources/css/app.css', 'public/css', [
        require('tailwindcss'),
    ])
    .postCss('resources/sass/custom_messenger.css', 'public/css/custom_messenger.css')
    .postCss('resources/sass/custom_tagify.css', 'public/css/custom_tagify.css')
    .copy('node_modules/trix/dist/trix.css', 'public/css/trix.css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .sourceMaps()
    .version()
    .autoload({ 'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery", 'global.jQuery', "global.$"] });

