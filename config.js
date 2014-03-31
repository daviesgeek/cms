exports.config = {
  conventions: {
    assets: /^app\/assets\/(?!css|js)/,
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
        '_/js/app.js': /^app\/admin\//,
        'public.js': /^app\/assets\/js\//,
        'vendor.js': /^bower_components\/(jquery|bootstrap)/,
        '_/js/vendor.js': /^(bower_components|vendor)/
      }
    },
    stylesheets: {
      joinTo: {
        'public.css': /(^app\/assets\/css\/|bower_components\/bootstrap\/)/,
        '_/css/app.css': /^(app|bower_components)/
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
