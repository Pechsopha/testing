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

const source = 'platform/packages/revision';
const dist = 'public/vendor/core/packages/revision';

mix
    .sass(source + '/resources/assets/sass/revision.scss', dist + '/css')
    .copy(dist + '/css/revision.css', source + '/public/css')

    .js(source + '/resources/assets/js/revision.js', dist + '/js')
    .copy(dist + '/js/revision.js', source + '/public/js');
