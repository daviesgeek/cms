exports.config = {
  conventions: {
    assets: /^app\/assets\/public/,
    ignored: /^(node_modules|app\/styles\/bootstrapsrc|(.*?\/)?[_]\w+)/
  },
  modules: {
    definition: 'commonjs',
    wrapper: 'commonjs'
  },
  paths: {
    "public": 'public'
  },
  files: {
    javascripts: {
      joinTo: {
        '_/js/app.js': /^app\/admin\//,
        'js/public.js': /^app\/assets\/js\//,
        '_/js/vendor.js': /^(bower_components|vendor)/
      }
    },
    stylesheets: {
      joinTo: {
        'css/public.css': /^app\/assets\/css\//,
        '_/css/app.css': /^(app|vendor|bower_components)/
      },
      order: {
        before: ['app/styles/main.less']
      }
    },
    templates: {
      joinTo: {
        '_/js/views.js': /^app\/admin\//
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
