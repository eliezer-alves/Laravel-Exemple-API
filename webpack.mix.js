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
mix.js('resources/js/app_vue.js', 'public/js')
    .postCss('resources/css/app_vue.css', 'public/css', [
        require('tailwindcss')
    ]).vue();

mix.js('resources/js/app_blade.js', 'public/js').postCss('resources/css/app_blade.css', 'public/css', [
    // require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);

mix.disableNotifications();
