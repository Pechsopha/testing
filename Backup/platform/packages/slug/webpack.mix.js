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

const source = 'platform/packages/slug';
const dist = 'public/vendor/core/packages/slug';

mix
    .js(source + '/resources/assets/js/slug.js', dist + '/js')
    .copy(dist + '/js/slug.js', source + '/public/js')
    .sass(source + '/resources/assets/sass/slug.scss', dist + '/css')
    .copy(dist + '/css/slug.css', source + '/public/css');
