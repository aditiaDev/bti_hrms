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
.styles([
  // 'resources/ace/css/responsive.dataTables.min.css',
  'resources/css/datatables.min.css',
], 'public/css/responsive.dataTables.css')
.styles([
  'resources/ace/css/sweetalert2.min.css',
], 'public/css/sweetalert2.css')
.styles([
  'resources/ace/css/select2.min.css',
], 'public/css/select2.css')
.styles([
  'resources/ace/css/jquery-ui.min.css',
], 'public/css/jquery-ui.css')
.scripts([
  'resources/ace/js/jquery-2.1.4.min.js',
], 'public/js/jquery.js')
.scripts([
  'resources/ace/js/jquery-ui.min.js',
], 'public/js/jquery-ui.js')
.scripts([
  'resources/ace/js/bootstrap.min.js',
], 'public/js/bootstrap.min.js')
.scripts([
  'resources/ace/js/ace-elements.min.js',
  'resources/ace/js/ace.min.js',
], 'public/js/ace.js')
.scripts([
  // 'resources/ace/js/jquery.dataTables.min.js',
  // 'resources/ace/js/jquery.dataTables.bootstrap.min.js',
  'resources/js/datatables.min.js',
], 'public/js/datatables.min.js')
.scripts([
  'resources/ace/js/sweetalert2.all.min.js',
], 'public/js/sweetalert2.js')
.scripts([
  'resources/ace/js/dataTables.responsive.min.js',
], 'public/js/dataTables.responsive.js')
.scripts([
  'resources/ace/js/select2.min.js',
], 'public/js/select2.js')
.scripts([
  'resources/ace/js/nik_parse.js',
], 'public/js/nik_parse.js')
.copyDirectory('resources/ace/css/images', 'public/css/images')
.copyDirectory('resources/assets/images', 'public/assets/images')
.sass('resources/sass/app.scss', 'public/css')
.sourceMaps();
