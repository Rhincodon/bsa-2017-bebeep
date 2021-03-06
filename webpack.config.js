const ExtractTextPlugin = require('extract-text-webpack-plugin');

const baseSettings = {
    development: {
        outputStyle: 'expanded'
    },
    production: {
        outputStyle: 'compressed'
    },
};
const settings = baseSettings[process.env.NODE_ENV];

module.exports = {
    module: {
        rules: [
            {
                test: /(\.css|\.scss|\.sass)$/,
                loader: ExtractTextPlugin.extract(
                    `css-loader?outputStyle=${settings.outputStyle}!sass-loader`
                )
            }
        ]
    },
    plugins: [
        new ExtractTextPlugin({
            filename: 'css/app.css',
            allChunks: true
        })
    ]
};
