const defaultConfig = require('@wordpress/scripts/config/webpack.config');
const path = require('path');

let entries = {}; // ビルドするファイル群
const srcDir = './src';
const entryDir = [
  'click-counter'
];
entryDir.forEach((key) => {
  entries[key + '/index'] = path.resolve(srcDir, key);
});

module.exports = {
  ...defaultConfig,
  entry: entries,
  output: {
    path: path.resolve(__dirname, 'build/'),
    filename: '[name].js',
  },
};