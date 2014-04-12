'use strict';

/**
 * Sample controller
 */

module.exports = function ($rootScope, $scope, $log, users) {
  $rootScope.title = 'Dashboard';
  $rootScope.h1 = 'Dashboard';  
  $rootScope.h1Class = 'dash';
  $rootScope.activePage = 'dash';
  $scope.$parent.activeSection = 'home';

  $scope.users = users;

}