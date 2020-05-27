var ExtractTextPlugin = require("extract-text-webpack-plugin");
const extractCSS = new ExtractTextPlugin("css/bundle.css");

module.exports = {
  entry: "./resources/js/index.js",
  output: {
    path: __dirname + "/public",
    filename: "js/bundle.js"
  },
  module: {
    rules: [
      {
        test: /\.js$/,
        exclude: /node_modules/,
        use: ["babel-loader"]
      },
      {
        test: /\.css$/,
        loader: extractCSS.extract(["css-loader"])
      }
    ]
  },
  plugins: [
    extractCSS
  ]
};