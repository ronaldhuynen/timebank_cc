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
    .js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css/app.css')
    .postCss('resources/css/app.css', 'public/css', [
        //
    ])
    .postCss('resources/sass/custom_messenger.css', 'public/css/custom_messenger.css')
    .copy('node_modules/trix/dist/trix.css', 'public/css/trix.css')
    .copy('node_modules/filepond/dist/filepond.min.css', 'public/css/filepond.min.css')
    .copy(
        'node_modules/@fortawesome/fontawesome-free/webfonts',
        'public/webfonts'
    )
    .sourceMaps()
    .version()
    .autoload({ 'jquery': ['$', 'window.jQuery', "jQuery", "window.$", "jquery", "window.jquery", 'global.jQuery', "global.$"] });

