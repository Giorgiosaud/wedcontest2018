module.exports = {
  module: {
    rules: [
      {
        // Matches all PHP or JSON files in `resources/lang` directory.
        test: /resources(\\|\/)lang.+\.(php|json)$/,
        loader: 'laravel-localization-loader',
      }
    ]
  }
}