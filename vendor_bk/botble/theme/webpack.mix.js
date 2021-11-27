let mix = require('laravel-mix');

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

const source = 'platform/packages/theme';
const dist = 'public/vendor/core/packages/theme';

mix
    .js(source + '/resources/assets/js/custom-css.js', dist + '/js')
    .copy(dist + '/js/custom-css.js', source + '/public/js')

    .js(source + '/resources/assets/js/theme-options.js', dist + '/js')
    .copy(dist + '/js/theme-options.js', source + '/public/js')

    .js(source + '/resources/assets/js/theme.js', dist + '/js')
    .copy(dist + '/js/theme.js', source + '/public/js')

    .sass(source + '/resources/assets/sass/custom-css.scss', dist + '/css')
    .copy(dist + '/css/custom-css.css', source + '/public/css')

    .sass(source + '/resources/assets/sass/theme-options.scss', dist + '/css')
    .copy(dist + '/css/theme-options.css', source + '/public/css')

    .sass(source + '/resources/assets/sass/admin-bar.scss', dist + '/css')
    .copy(dist + '/css/admin-bar.css', source + '/public/css');
