const path = require('path');

module.exports = {
    entry: 'main.js',
    output: {
        path: path.resolve(__dirname, '../public/assets/scripts/'),
        filename: "bundle.js"
    },
    module: {
        loaders: [{
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: /node_modules/
        }, {
            test: /\.vue$/,
            loader: 'vue-loader'
        }, {
            test: /\.scss$/,
            loader: 'style!css!sass'
        }]
    }
};
