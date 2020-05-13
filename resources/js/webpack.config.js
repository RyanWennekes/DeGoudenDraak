const VuetifyLoaderPlugin = require('vuetify-loader/lib/plugin');

// Using Webpack so we can export VuetifyLoaderPlugin
module.exports = {
    plugins: [
        new VuetifyLoaderPlugin(),
    ],
};
