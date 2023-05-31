const mix = require('laravel-mix');

mix.extend('esbuild', (webpackConfig, { options }) => {
    const esbuildRule = {
        test: /\.(js|jsx)$/,
        loader: require.resolve('esbuild-loader'),
        options: {
            loader: 'jsx',
            target: 'es2015'
        }
    };

    webpackConfig.module.rules.push(esbuildRule);

    return webpackConfig;
});

mix.js('resources/js/app.js', 'public/js')
    .esbuild()
    .react()
    .postCss('resources/css/app.css', 'public/css', [
        //
    ]);
