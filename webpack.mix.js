let mix = require("laravel-mix");
let tailwindcss = require("tailwindcss");
// add translations to vue
// mix.webpackConfig({
//     resolve: {
//         modules: [
//             path.resolve(__dirname, 'laravelLoc.setup.js')
//         ]
//     }
// });
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

mix
  .js("resources/assets/js/app.js", "public/js")
  .sass("resources/assets/sass/app.scss", "public/css")
  .options({
    processCssUrls: false,
    postCss: [tailwindcss("./tailwind.js")]
  })
  .browserSync("https://wedcontest.develop/");
