let mix = require('laravel-mix');

const dist = 'public/vendor/core/plugins/simple-slider';
const source = './platform/plugins/simple-slider';

mix
    .js(source + '/resources/assets/js/simple-slider.js', dist + '/js')
    .js(source + '/resources/assets/js/simple-slider-admin.js', dist + '/js')

    .sass(source + '/resources/assets/sass/simple-slider.scss', dist + '/css')
    .sass(source + '/resources/assets/sass/simple-slider-admin.scss', dist + '/css')

    .copy(dist + '/js', source + '/public/js')
    .copy(dist + '/css', source + '/public/css');
