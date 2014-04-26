'use strict';

/**
 * Routing for pages
 * url: "/pages/*"
 */

angular
  .module('routes:pages', [])
  .controller('pages', require('./controllers/pages'))
  .config(function($stateProvider) {
    $stateProvider
      .state('pages', {
        url: '/pages',
        template: require('./views/pages'),
        controller: 'pages',
        resolve: {
          pages: function(Page) {
            return Page.getList();
          }
        }
      })
  })