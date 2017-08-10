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
    resolve: {
        modules: [
            path.join(__dirname, 'resources/assets/js'),
            path.join(__dirname, 'resources/assets/js/features'),
            'node_modules'
        ],
        alias: {
            // Features aliases
            user: path.join(__dirname, 'resources/assets/js/features/user'),
            vehicle: path.join(__dirname, 'resources/assets/js/features/vehicle'),
            trip: path.join(__dirname, 'resources/assets/js/features/trip'),
            booking: path.join(__dirname, 'resources/assets/js/features/booking'),
        },
        extensions: ['.js', '.jsx', '.json', '.scss', '.jpg', '.png']
    },
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
