const mix = require("laravel-mix");

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

// mix.js("resources/js/app.js", "public/js")
//     .sass("resources/sass/app.scss", "public/css")
//     .sourceMaps();

/**
 * Compiling js
 */
mix.js("resources/js/app.js", "public/js");

/**
 * Compiling dahboard sass
 */
mix.sass("resources/sass/app.scss", "public/css");
mix.sass("resources/sass/theme.scss", "public/css/theme.css");

/**
 * Compiling site
 */
mix.js("resources/js/site/site.js", "public/js/site");
mix.sass("resources/sass/site/site.scss", "public/css/site");

/**
 * Moving images to public folder
 */
mix.copyDirectory("resources/media", "public/media");

// /**
//  * Production improvements
//  */
// if (mix.inProduction()) {
//     mix.version();
//     mix.sourceMaps();
// }

// mix.webpackConfig({
//     stats: {
//         children: true,
//     },
// });
