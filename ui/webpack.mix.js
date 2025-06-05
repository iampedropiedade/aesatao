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
    .setPublicPath('./../service/application/themes/aesatao/app')
    .copyDirectory('fonts', './../service/application/themes/aesatao/app/fonts')
    .copyDirectory('css/plugins', './../service/application/themes/aesatao/app/css/plugins')
    .copyDirectory('js/plugins', './../service/application/themes/aesatao/app/js/plugins')
    .copyDirectory('img', './../service/application/themes/aesatao/app/img')
    .copyDirectory('favicons', './../service/application/themes/aesatao/app/favicons')
    .copyDirectory('node_modules/@fortawesome/fontawesome-free/webfonts', './../service/application/themes/aesatao/app/css/webfonts')
    .postCss("css/main.css", "./../service/application/themes/aesatao/app/css", [require("tailwindcss")])
    .js('js/main.js', './../service/application/themes/aesatao/app/js/main.js')
    .js('js/bootstrap.js', './../service/application/themes/aesatao/app/js/plugins/bootstrap.js')
    .vue()