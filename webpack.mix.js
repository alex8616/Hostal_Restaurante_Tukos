const mix = require('laravel-mix');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

mix.js('resources/js/app.js', 'public/js')
    .sass('resources/sass/app.scss', 'public/css')
    .webpackConfig({
        plugins: [
            new BrowserSyncPlugin({
                proxy: 'http://localhost:8080',
                files: [
                    'app/**/*.php',
                    'resources/views/**/*.php',
                    'public/js/**/*.js',
                    'public/css/**/*.css'
                ]
            })
        ]
    });
