'use strict'

import pkg from './package.json'
import bourbon from 'node-bourbon'
import notify from 'gulp-notify'
import gutil from 'gulp-util'

const isProduction = gutil.env.type === 'production'
const themePath = `./themes/${pkg.name}`

module.exports = {
  isProduction: isProduction,
  src: {
    sass: './assets/sass',
    javascripts: './assets/javascripts',
    images: './assets/images',
    components: './node_modules',
  },
  dist: {
    css: `${themePath}/assets/css`,
    js: `${themePath}/assets/js`,
    images: `${themePath}/assets/images`,
    fonts: `${themePath}/assets/fonts`,
  },
  plumberErrorHandler: {
    errorHandler: notify.onError({
      title   : 'Gulp',
      message : 'Error: <%= error.message %>'
    })
  },
  cssnano: {
    reduceIdents: false,
    autoprefixer: {
      browsers: [
        'last 2 versions',
        'safari >= 8',
        'ie >= 10',
        'ff >= 20',
        'ios 6',
        'android 4'
      ], add: true
    }
  },
  includeConfig: {
    extensions: 'js',
    includePaths: [
      './node_modules',
      './javascripts'
    ]
  },
  sassConfig: {
    sourceComments: isProduction ? false : 'normal',
    includePaths: [
      bourbon.includePaths,
      './node_modules',
      './sass'
    ]
  },
  banner: [
    '/**!',
    '* <%= pkg.name %> - <%= pkg.description %>',
    '* @version v<%= pkg.version %>',
    '* @link <%= pkg.homepage %>',
    '* @author v<%= pkg.author %>',
    '*/'
  ]
}
