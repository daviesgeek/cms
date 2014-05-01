'use strict'

/**
 * Routing module for front-end editing
 */

angular
  .module('routes', [])
  .controller('edit', require('./controllers/edit'))
  .config(function($stateProvider) {
    $stateProvider
    .state('edit', {
      url: '/'
    })
  })