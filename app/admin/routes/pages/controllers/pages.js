'use strict'

/**
 * Pages controller
 * url: "/pages"
 */

module.exports = function ($rootScope, $scope, $log, pages, $state, $filter) {
  $rootScope.title = 'Page';
  $scope.pages = pages;
  $scope.editingPages = {};

  $scope.toggleActive = function(page, status) {
    page.active = status;
    page.patch({active: page.active}).then(function(response) {});
  }

  $scope.openEdit = function(page) {
    $scope.editingPages[page.id] = true;
  }

  $scope.closeEdit = function(page) {
    $scope.editingPages[page.id] = false;
  }

  $scope.openCreatePage = function() {
    $scope.createPage = true;
    $scope.newPage = {active: 1};
  }

  $scope.saveNewPage = function(page) {
    var form = $scope.validateForm('newPage');
    page.url = $filter('toUrl')(page.name);
    if(form.isValid()) {
      pages.create(page).then(function(response) {
        pages.push(response);
        $scope.createPage = false;
        $scope.newPage = {};
      });
    }
  }

  $scope.deletePage = function(page) {
    page.remove().then(function(response) {
      $scope.pages.splice($scope.pages.indexOfID(page.id), 1);
    });
  }

}