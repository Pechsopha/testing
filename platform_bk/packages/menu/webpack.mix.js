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

const source = 'platform/packages/menu';
const dist = 'public/vendor/core/packages/menu';

mix
    .js(source + '/resources/assets/js/menu.js', dist + '/js')
    .copy(dist + '/js/menu.js', source + '/public/js')
    .sass(source + '/resources/assets/sass/menu.scss', dist + '/css')
    .copy(dist + '/css/menu.css', source + '/public/css');
