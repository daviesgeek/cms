'use strict'

/**
 * Navigation controller
 * @author Matthew Davies
 * @created April 4th, 2014
 */

module.exports = function ($rootScope, $scope, $log, Session) {
  $rootScope.title = 'Admin';
  $rootScope.h1 = 'Admin';  

  $scope.session = Session.getAll();
}