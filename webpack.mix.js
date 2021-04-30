const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css');
mix.sass('resources/sass/frontend/frontend.scss', 'public/css/frontend.css');

mix.scripts([
    'resources/sass/frontend/assets/js/jquery-1.11.1.min.js',
    'resources/sass/frontend/assets/js/bootstrap.min.js',
    'resources/sass/frontend/assets/js/bootstrap-hover-dropdown.min.js',
    'resources/sass/frontend/assets/js/owl.carousel.min.js',
    'resources/sass/frontend/assets/js/echo.min.js',
    'resources/sass/frontend/assets/js/jquery.easing-1.3.min.js',
    'resources/sass/frontend/assets/js/bootstrap-slider.min.js',
    'resources/sass/frontend/assets/js/jquery.rateit.min.js',
    'resources/sass/frontend/assets/js/lightbox.min.js',
    'resources/sass/frontend/assets/js/bootstrap-select.min.js',
    'resources/sass/frontend/assets/js/wow.min.js',
    'resources/sass/frontend/assets/js/scripts.js',
], 'public/js/frontend.js');

mix.js('resources/js/app2.js', 'public/js/app2.js');

// mix.copyDirectory('resources/sass/frontend/assets/images', 'public/frontend/images');
