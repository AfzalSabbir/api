const mix = require('laravel-mix');
// const tailwindcss = require('tailwindcss');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
**/


mix.js('resources/assets/js/app_pre.js', 'public/js').sourceMaps()
.options({
	processCssUrls: false
});

mix.js('resources/assets/js/app.js', 'public/js').sourceMaps()
.sass('resources/assets/sass/app.scss', 'public/css')
.options({
	processCssUrls: false
});


mix.js('resources/assets/backend/js/app.js', 'public/backend/js').sourceMaps()
.sass('resources/assets/backend/sass/app.scss', 'public/backend/css')
/*.postCss('resources/assets/backend/sass/tailwindcss.css', 'public/backend/css', [
  require('tailwindcss'),
])*/
.options({
	processCssUrls: false
});


// mix.sass('resources/assets/backend/sass/bulma/bulma.sass', 'public/backend/css')
// .options({
// 	processCssUrls: false
// });
