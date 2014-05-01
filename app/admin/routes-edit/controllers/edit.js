'use strict'

/**
 * Edit.js controller
 */

module.exports = function ($rootScope, $scope, $log, Page, $window) {
  var pageID = $window.pageID;

  $scope.isEditing = false;

  Page.get(pageID+'/edits').then(function(response) {
    $scope.html = response[$scope.currentSection].text;
  });

  $scope.toggleEditing = function() {
    $scope.isEditing = !$scope.isEditing;
  }

  $scope.saveEdit = function() {
    // Page.patch(pageID).then(function(response) {
    // });
  }

}