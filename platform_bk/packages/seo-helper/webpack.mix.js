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

const source = 'platform/packages/seo-helper';
const dist = 'public/vendor/core/packages/seo-helper';

mix
    .js(source + '/resources/assets/js/seo-helper.js', dist + '/js')
    .copy(dist + '/js/seo-helper.js', source + '/public/js')

    .sass(source + '/resources/assets/sass/seo-helper.scss', dist + '/css')
    .copy(dist + '/css/seo-helper.css', source + '/public/css');
