const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
.styles([
  'resources/ace/css/bootstrap.min.css',
  'resources/ace/css/fonts.googleapis.com.css',
  'resources/ace/css/ace.min.css',
], 'public/css/ace.css')
.scripts([
  'resources/ace/js/jquery-2.1.4.min.js',
], 'public/js/jquery.js')
.copyDirectory('resources/ace/css/images', 'public/css/images')
.sass('resources/sass/app.scss', 'public/css')
.sourceMaps();
