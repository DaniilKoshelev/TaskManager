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
        exclude: /node_modules/
      }
    ]
  }
};