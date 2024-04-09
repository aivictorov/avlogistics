let mix = require('laravel-mix');

mix.sass('resources/scss/admin.scss', 'public/css')
    .sass('resources/scss/style.scss', 'public/css');

// mix.disableSuccessNotifications();
// mix.disableNotifications();
// mix.setPublicPath('dist');