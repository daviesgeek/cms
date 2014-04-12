'use strict'

/**
 * Routing for users
 * url: "/users/*"
 */

angular
  .module('routes:users', [])
  .controller('users:users', require('./controllers/users'))
  .config(function($stateProvider) {
    $stateProvider
      .state('users', {
        url: '/users',
        template: require('./views/users'),
        controller: 'users:users',
        resolve: {
          users: function(User) {
            return User.customGET();
          },
        }
      })
  })