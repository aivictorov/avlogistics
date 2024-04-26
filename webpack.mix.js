let mix = require('laravel-mix');

mix.sass('resources/scss/admin.scss', 'public/css')
    .sass('resources/scss/style.scss', 'public/css');

mix.js('resources/js/admin.js', 'public/js')
    .js('resources/js/main.js', 'public/js')


// mix.disableSuccessNotifications();
// mix.disableNotifications();
// mix.setPublicPath('dist');