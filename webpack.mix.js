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

mix.js('resources/assets/js/app.js', 'public/js')

mix.styles([
    'resources/assets/plugins/bootstrap/dist/css/bootstrap.min.css',
    'resources/assets/plugins/font-awesome/css/font-awesome.min.css',
    'resources/assets/plugins/Ionicons/css/ionicons.min.css',
    'resources/assets/css/_all-skins.css',
    'resources/assets/css/AdminLTE.css',
    'resources/assets/plugins/morris.js/morris.css'
], 'public/css/vendor.css', './');

mix.scripts([
    'resources/assets/plugins/jquery/dist/jquery.min.js',
    'resources/assets/plugins/jquery-ui/jquery-ui.min.js',
    'resources/assets/plugins/bootstrap/dist/js/bootstrap.min.js',
    'resources/assets/plugins/raphael/raphael.min.js',
    'resources/assets/plugins/morris.js/morris.min.js',
    'resources/assets/plugins/jquery-sparkline/dist/jquery.sparkline.min.js',
    'resources/assets/plugins/jquery-knob/dist/jquery.knob.min.js',
    'resources/assets/plugins/moment/min/moment.min.js',
    'resources/assets/plugins/jquery-slimscroll/jquery.slimscroll.min.js',
    'resources/assets/plugins/fastclick/lib/fastclick.js',
    'resources/assets/js/adminlte.js',
    'resources/assets/plugins/morris.js/morris.min.js',
    'resources/assets/plugins/morris.js/morris.min.js',
], 'public/js/vendor.js');

