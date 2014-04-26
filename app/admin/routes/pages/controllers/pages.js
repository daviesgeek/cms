'use strict'

/**
 * Pages controller
 * url: "/pages"
 */

module.exports = function ($rootScope, $scope, $log, pages) {
  $rootScope.title = 'Page';
  $scope.pages = pages;

  $scope.toggleActive = function(page) {
    page.active = page.active == 1 ? 0 : 1;
    page.patch().then(function(response) {
      
    });
  }

}