let mix = require('laravel-mix');

const dist = 'public/vendor/core/plugins/facebook';
const source = './platform/plugins/facebook';

mix
    .sass(source + '/resources/assets/sass/facebook.scss', dist + '/css')
    .copy(dist + '/css', source + '/public/css');
