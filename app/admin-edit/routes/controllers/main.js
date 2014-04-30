'use strict'

/**
 * Main.js
 */

module.exports = function ($rootScope, $scope, $log, Page, $window) {
  $scope.textModel = 'This is the text model';

  Page.get($window.pageID+'/edits').then(function (response) {
    $scope.edits = response;
  });

  $scope.editing = true;

  $scope.toggleEdit = function () {
    $scope.editing = !$scope.editing;
  }
}