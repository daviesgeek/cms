'use strict';

/**
 * Routing for pages
 * url: "/pages/*"
 */

angular
  .module('routes:pages', [])
  .config(function($stateProvider) {
    $stateProvider
      .state('pages', {
        url: '/pages',
        template: require('./views/pages'),
      })
  })