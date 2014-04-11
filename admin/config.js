exports.config = {
  conventions: {
    assets: /^admin\/assets\/(?!css|js)/,
    ignored: /^(node_modules|(.*?\/)?[_]\w+)/
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
        '_/js/app.js': /^admin\//,
        'public.js': /^admin\/assets\/js\//,
        'vendor.js': /^bower_components\/(jquery|bootstrap)/,
        '_/js/vendor.js': /^bower_components/
      }
    },
    stylesheets: {
      joinTo: {
        'public.css': /(^admin\/assets\/css\/|bower_components\/bootstrap\/)/,
        '_/css/app.css': /^(app|bower_components)/
      },
      order: {
        before: ['app/styles/main.less']
      }
    },
    templates: {
      joinTo: {
        '_/js/views.js': /^admin\//
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