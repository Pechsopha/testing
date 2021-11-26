let mix = require('laravel-mix');

const source = 'platform/themes/lara-mag';
const dist = 'public/themes/lara-mag';

mix
    .sass(source + '/assets/sass/lara-mag.scss', dist + '/css')
    .copy(dist + '/css/lara-mag.css', source + '/public/css')
    .scripts(
        [
            source + '/assets/js/jquery.min.js',
            source + '/assets/js/custom.js',
            source + '/assets/js/jquery.fancybox.min.js'
        ], dist + '/js/lara-mag.js')
    .copy(dist + '/js/lara-mag.js', source + '/public/js');
