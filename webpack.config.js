const path = require('path');
const glob = require('glob');
const defaultConfig = require('@wordpress/scripts/config/webpack.config');

// 1. Block entries
const blockEntries = {};
glob.sync('./src/blocks/**/index.js').forEach((file) => {
  const match = file.match(/src\/blocks\/(.+)\/index\.js$/);
  if (match) {
    const blockName = match[1];
    blockEntries[`blocks/${blockName}/index`] = path.resolve(__dirname, file);
  }
});

// 2. Component entries (each individual file inside src/components/)
const componentEntries = {};
glob.sync('./src/components/*.{js,jsx,ts,tsx}').forEach((file) => {
  const fileName = path.basename(file, path.extname(file));
  componentEntries[`components/${fileName}`] = path.resolve(__dirname, file);
});

module.exports = {
  ...defaultConfig,
  entry: {
    ...blockEntries,
    ...componentEntries,
  },
  output: {
    ...defaultConfig.output,
    path: path.resolve(__dirname, 'build'),
    filename: '[name].js',
  },
  resolve: {
    ...defaultConfig.resolve,
    alias: {
      ...(defaultConfig.resolve?.alias || {}),
      '@components': path.resolve(__dirname, 'src/components'),
    },
  },
};