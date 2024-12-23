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

mix.js('resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css', [
        require("tailwindcss"),
        require("autoprefixer"),
    ]);

// mix.js(`public/themes/pro/${process.env.DBR_THEME}/resources/js/bundle.js`, `public/themes/pro/${process.env.DBR_THEME}/resources/js/app.js`)
//     .react();

const NodePolyfillPlugin = require("node-polyfill-webpack-plugin")
mix.webpackConfig(webpack => {
    return {
        plugins: [
            new NodePolyfillPlugin(),
        ]
    };
})

mix.browserSync({
    proxy: {
        target: 'http://localhost:8000',
    },
    files: [
        './resources/**/*', `./dabory/themes/${process.env.DBR_THEME}/pro/resources/**/*`,
        './app/**/*', `./dabory/themes/${process.env.DBR_THEME}/pro/app/**/*`,
        './routes/**/*', `./dabory/themes/${process.env.DBR_THEME}/pro/routes/**/*`,
        './dabory/para/**/*', `./dabory/themes/${process.env.DBR_THEME}/erp/para/**/*`,
        './public/js/**/*', './public/css/**/*', './public/dabory/**/*',
    ],
    // watchOptions: {
    //     usePolling: true
    // },
    open: false,
});
