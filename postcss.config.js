const postcssImport = require('postcss-import');
const postcssNested = require('postcss-nested');
const postcssSimpeVars = require('postcss-simple-vars');
const tailwindcss = require('tailwindcss');
const autoprefixer = require('autoprefixer');

const plugins = [
  postcssImport, // Sass like Import
  tailwindcss('./tailwind.config.js'),
  postcssNested, // Sass like nesting
  postcssSimpeVars, // Sass like variables
  autoprefixer
];

module.exports = { plugins };