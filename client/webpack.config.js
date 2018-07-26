module.exports = {
  entry: {
    app: ['babel-polyfill', 'whatwg-fetch', "./src/index.tsx"]
  },
  output: {
    path: __dirname + "/build",
    publicPath: "/build/",
    filename: "bundle.js"
  },
  resolve: {
    // Add '.ts' and '.tsx' as resolvable extensions.
    extensions: [".webpack.js", ".web.js", ".ts", ".tsx", ".js"]
  },
    devtool: "source-map",
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        use: ['babel-loader?presets[]=env', 'awesome-typescript-loader?' + JSON.stringify({transpileOnly:true})]
      },
      {
        test: /\.js$/,
        enforce: "pre",
        loader: "source-map-loader"
      }
    ]
  },
  devServer: {
    historyApiFallback: true
  }
};