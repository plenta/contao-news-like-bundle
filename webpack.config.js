let Encore = require('@symfony/webpack-encore');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');
const CopyWebpackPlugin = require('copy-webpack-plugin');
const BrowserSyncConfig = require('./webpack.config.browsersync.js');
const url = require("url");
const fileSync = require("fs");
const mime = require("mime");

Encore
    .setOutputPath('public')
    .setPublicPath('/bundles/plentanewslike')
    .setManifestKeyPrefix('plentanewslike')

    .addEntry('layout', './layout/js/layout.js')
    //.splitEntryChunks()

    // will require an extra script tag for runtime.js
    // but, you probably want this, unless you're building a single-page app
    //.enableSingleRuntimeChunk()
    .disableSingleRuntimeChunk()

    .cleanupOutputBeforeBuild()
    .enableSourceMaps(!Encore.isProduction())
    .enablePostCssLoader()
    .enableSassLoader()
    // enables hashed filenames (e.g. app.abc123.css)
    .enableVersioning(Encore.isProduction())

    // enables @babel/preset-env polyfills
    /*.configureBabelPresetEnv((config) => {
        config.useBuiltIns = 'usage';
        config.corejs = 3;
    })*/
    .configureBabel(function(babelConfig) {
        babelConfig.plugins.push('@babel/plugin-transform-runtime');
    }, {})

    .addPlugin(
        new BrowserSyncPlugin({
            // browse to http://localhost:3000/ during development,
            // ./public directory is being served
            host: BrowserSyncConfig.BrowserSyncHost,
            port: BrowserSyncConfig.BrowserSyncPort,
            //server: { baseDir: ['layout'] },
            proxy: BrowserSyncConfig.BrowserSyncProxy,
            browser: BrowserSyncConfig.BrowserSyncBrowser,
            middleware: [
                function (req, res, next) {
                    let parsed = url.parse(req.url);
                    let match = parsed.pathname.match(/bundles\/plentanewslike\/layout\.(.+)\.js$/);
                    if (match) {
                        let path = 'public/layout.js';
                        try {
                            if (fileSync.existsSync(path)) {
                                let text = fileSync.readFileSync(path).toString('utf-8');
                                res.setHeader('Content-Type', 'application/javascript');
                                res.end(text);
                            }
                        } catch (err) {}

                        return;
                    }
                    next();
                },
                function (req, res, next) {
                    let parsed = url.parse(req.url);
                    let match = parsed.pathname.match(/bundles\/plentanewslike\/layout_js(.+)\.(.+)$/);
                    if (match) {
                        let path = 'public/layout_js'+match[1]+'.'+match[2];
                        try {
                            if (fileSync.existsSync(path)) {
                                res.setHeader('Content-Type', mime.getType(path));
                                res.end(fileSync.readFileSync(path));
                            }
                        } catch (err) {}

                        return;
                    }
                    next();
                },
                function (req, res, next) {
                    let parsed = url.parse(req.url);
                    let match = parsed.pathname.match(/bundles\/plentanewslike\/images\/(.+)\.(.+)\.(.+)$/);
                    if (match) {
                        let path = 'public/images/'+match[1]+'.'+match[2]+'.'+match[3];
                        try {
                            if (fileSync.existsSync(path)) {
                                res.setHeader('Content-Type', mime.getType(path));
                                res.end(fileSync.readFileSync(path));
                            }
                        } catch (err) {}

                        return;
                    }
                    next();
                },
            ]
        })
    );

let defaultConfig = Encore.getWebpackConfig();

// Enable Sass @debug
if (defaultConfig.stats.loggingDebug) {
    defaultConfig.stats.loggingDebug.push = 'sass-loader';
} else {
    defaultConfig.stats.loggingDebug = [];
    defaultConfig.stats.loggingDebug.push('sass-loader');
}

defaultConfig.name = 'default';

module.exports = [defaultConfig];