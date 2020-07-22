const path = require('path')

module.exports = {
  devtool: 'source-map',
  entry: {
    // eslint-disable-next-line @typescript-eslint/camelcase
    app: './resources/ts/app.tsx',
  },
  module: {
    rules: [
      {
        test: /\.tsx?$/,
        exclude: /node_modules/,
        use: {
          loader: 'ts-loader'
        }
      }
    ]
  },
  resolve: {
    extensions: ['.ts', '.tsx', '.js']
  },
  output: {
    path: path.resolve(__dirname, 'resources/js'),
    publicPath: '/',
    filename: 'bundle_[name].js'
  }
}
