const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

//central application
mix.scripts(['resources/js/vendor/jquery-3.5.1.js'], 'public/assets/central/js/jquery.js').version();

mix.scripts(['resources/js/vendor/bootstrap-4.0.0.min.js', 'resources/js/vendor/popper.1.12.9.min.js', 'resources/js/app.js'], 'public/assets/central/js/app.js').version();

mix.styles(['resources/css/vendor/bootstrap-4.0.0.min.css', 'resources/css/app.css'], 'public/assets/central/css/app.css').version();


//tenant application
mix.scripts(['resources/js/vendor/jquery-3.5.1.js'], 'public/assets/tenant/js/jquery.js').version();

mix.scripts(['resources/js/vendor/bootstrap-4.0.0.min.js', 'resources/js/vendor/popper.1.12.9.min.js', 'resources/js/app.js'], 'public/assets/tenant/js/app.js').version();

mix.styles(['resources/css/vendor/bootstrap-4.0.0.min.css', 'resources/css/app.css'], 'public/assets/tenant/css/app.css').version();
