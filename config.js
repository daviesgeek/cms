/**
 * Configuration for Brunch.io
 * Based off angular-brunch-seed
 * https://github.com/scotch/angular-brunch-seed
 */

exports.config = {
  conventions: {
    assets: /^app\/assets\/(?!css|js)/,
    ignored: /^(node_modules|app\/admin\/styles\/bootstrapsrc|(.*?\/)?[_]\w+)/
  },
  modules: {
    definition: 'commonjs',
    wrapper: 'commonjs'
  },
  paths: {
    "public": 'public/assets'
  },
  files: {
    javascripts: {
      joinTo: {
        'public.js': /^app\/assets\/js/,
        '_admin/js/app.js': /^app\/admin/,
        '_admin/js/vendor.js': /^bower_components/
      }
    },
    stylesheets: {
      joinTo: {
        'public.css': /^app\/assets\/css/,
        '_admin/css/app.css': /^(app\/admin|bower_components)/
      },
      order: {
        before: ['app/styles/main.less']
      }
    },
    templates: {
      joinTo: {
        '_admin/js/views.js': /^app\/admin/
      }
    }
  },
  plugins: {
    jade: {
      pretty: true
    },
    uglify: {
      mangle: false,
      compress: true
    }
  }
};
