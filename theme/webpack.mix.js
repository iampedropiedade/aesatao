let mix = require('laravel-mix');

mix.webpackConfig({
    externals: {
        jquery: 'jQuery',
    },
});

mix.define({
    __VUE_PROD_HYDRATION_MISMATCH_DETAILS__: false
});

require('mix-tailwindcss');
mix
    .options({processCssUrls: false})
    .setPublicPath('./app')
    .copyDirectory('assets/js/plugins', './app/js/plugins')
    .copyDirectory('assets/fonts', './app/fonts')
    .copyDirectory('assets/css/plugins', './app/css/plugins')
    .copyDirectory('assets/img', './app/img')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', './app/webfonts')
    .postCss("assets/css/main.css", "./app/css", [require("tailwindcss")])
    .js('assets/js/main.js', './app/js/main.js')
    .js('assets/js/bootstrap.js', './app/js/plugins/bootstrap.js')
    .vue()