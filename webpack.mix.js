let mix = require('laravel-mix');

mix.webpackConfig({ devtool: 'source-map' })

mix.sass('resources/scss/main.scss', 'public/css')
    .sourceMaps();

mix.js('resources/js/admin/admin.js', 'public/js')
    .js('resources/js/site/main.js', 'public/js')

mix.browserSync('127.0.0.1:8000');

mix.disableSuccessNotifications();
mix.disableNotifications();