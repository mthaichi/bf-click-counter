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

// sass-loaderの設定を修正してlegacy JS API警告を解決
const modifiedRules = defaultConfig.module.rules.map(rule => {
  if (rule.test && rule.test.toString().match(/s\[ac\]ss/)) {
    const modifiedRule = { ...rule };
    if (Array.isArray(modifiedRule.use)) {
      modifiedRule.use = modifiedRule.use.map(useItem => {
        if (typeof useItem === 'string' && useItem.includes('sass-loader')) {
          return {
            loader: useItem,
            options: {
              implementation: require('sass'),
              api: 'modern'
            }
          };
        }
        if (typeof useItem === 'object' && useItem.loader && useItem.loader.includes('sass-loader')) {
          return {
            ...useItem,
            options: {
              ...useItem.options,
              implementation: require('sass'),
              api: 'modern'
            }
          };
        }
        return useItem;
      });
    }
    return modifiedRule;
  }
  return rule;
});

module.exports = {
  ...defaultConfig,
  entry: entries,
  output: {
    path: path.resolve(__dirname, 'build/'),
    filename: '[name].js',
  },
  module: {
    ...defaultConfig.module,
    rules: modifiedRules
  }
};