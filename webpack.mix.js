const mix = require('laravel-mix');
const path = require('path')

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

const webpack = require('webpack');

/*
mix.webpackConfig ({
  plugins: [
    new webpack.DefinePlugin({
      __VUE_OPTIONS_API__: false,
      __VUE_PROD_DEVTOOLS__: false,
    }),
  ],
});
*/

mix.js('resources/js/app.js', 'public/js')
    .vue()
    .alias({
        '@': path.join(__dirname, 'resources/js')
    })
    .webpackConfig({
      output: { chunkFilename: 'js/[name].js?id=[chunkhash]' }
    });

mix.postCss('resources/css/app.css', 'public/css', [
     require("tailwindcss"),
]);

mix.copy('node_modules/v-calendar/dist/style.css', 'public/css/v-calendar.css');

mix.options({
	legacyNodePolyfills: false
});

mix.sourceMaps();
mix.version();
