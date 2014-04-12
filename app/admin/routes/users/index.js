'use strict'

/**
 * Routing for users
 * url: "/users/*"
 */

angular
  .module('routes:users', [])
  .config(function($stateProvider) {
    $stateProvider
      .state('users', {
        url: '/users',
        template: require('./views/users')
      })
  })