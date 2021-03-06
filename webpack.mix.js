const mix = require('laravel-mix');

const fs = require('fs');
 
 fs.symlink(
     path.resolve('vendor/ckeditor/ckeditor'),
     path.resolve('public/js/ckeditor'),
     function (err) { err != null && err.errno != -17 ? console.log(err) : console.log("Done."); }
 );

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
.sass('resources/sass/app.scss', 'public/css')
.sass('resources/sass/admin.scss', 'public/css').extract().version();

mix.copy('node_modules/@defvayne23/svg-marker/SVGMarker.min.js', 'public/js/SVGMarker.min.js');
mix.copy('node_modules/slick-carousel/slick', 'public/vendor/slick');
mix.copy('node_modules/@fortawesome/fontawesome-free', 'public/vendor/fontawesome');
