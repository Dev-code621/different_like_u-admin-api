const mix = require('laravel-mix');

require('laravel-mix-purgecss');
require('laravel-mix-postcss-config');
require('laravel-mix-alias');

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

mix.alias({
  '@': '/resources/js',
  '~': '/resources/css',
});

mix.react('resources/js/index.js', 'public/js')
  .postCss('resources/css/app.css', 'public/css')
  .postCssConfig();

if (mix.inProduction()) {
  mix
    .version()
    .purgeCss();
}
