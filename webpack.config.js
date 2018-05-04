// var Encore = require('@symfony/webpack-encore'); Encore
//    .setOutputPath('public/build/')
//    .setPublicPath('/build')
//    .cleanupOutputBeforeBuild()
//    .enableSourceMaps(!Encore.isProduction())
//    .addEntry('js/app', './assets/js/app.js')
//    // .addStyleEntry('css/app', './assets/css/app.scss')
//    // .enableSassLoader()
//    // .autoProvidejQuery()


//    // Enable Vue loader
//    .enableVueLoader()
// ;

// module.exports = Encore.getWebpackConfig();


var Encore = require('@symfony/webpack-encore');

Encore
    // the project directory where all compiled assets will be stored
    .setOutputPath('web/build/')

    // the public path used by the web server to access the previous directory
    .setPublicPath('/build')

    // will create web/build/app.js and web/build/app.css
    .addEntry('app', './assets/js/app.js')

    // allow legacy applications to use $/jQuery as a global variable
    // .autoProvidejQuery()

    // enable source maps during development
    .enableSourceMaps(!Encore.isProduction())

    // empty the outputPath dir before each build
    .cleanupOutputBeforeBuild()

    // show OS notifications when builds finish/fail
    .enableBuildNotifications()

    // create hashed filenames (e.g. app.abc123.css)
    // .enableVersioning()

    // allow sass/scss files to be processed
    // .enableSassLoader()

    // Enable Vue loader
   .enableVueLoader()
;

// export the final configuration
module.exports = Encore.getWebpackConfig();