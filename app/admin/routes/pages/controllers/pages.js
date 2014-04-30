'use strict'

/**
 * Pages controller
 * url: "/pages"
 */

module.exports = function ($rootScope, $scope, $log, pages, $state, $filter, $stateParams) {
  $rootScope.title = 'Page';
  $scope.pages = pages;
  $scope.editingPages = {};
  $scope.saveTracker = false;
  $scope.updateTrackers = {};
  $scope.deleteTrackers = {};

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
    $scope.newPage = {active: 1, template_id: 1};
  }

  $scope.saveNewPage = function(page) {
    var form = $scope.validateForm('newPage');
    $scope.saveTracker = true;
    page.url = $filter('toUrl')(page.name);
    if(form.isValid()) {
      $scope.savePromise = pages.create(page).then(function(response) {
        pages.push(response);
        $scope.createPage = false;
        $scope.newPage = {};
        $scope.saveTracker = false;
      });
    }
  }

  $scope.deletePage = function(page) {
    $scope.deleteTrackers[page.id] = true;
    page.remove().then(function(response) {
      $scope.pages.splice($scope.pages.indexOfID(page.id), 1);
      $scope.deleteTrackers[page.id] = false;
    });
  }

  $scope.updatePage = function(page) {
    $scope.updateTrackers[page.id] = true;
    page.patch().then(function(response) {
      $scope.updateTrackers[page.id] = false;
      $scope.updateTrackers[page.id] = false;
    });

  }

}