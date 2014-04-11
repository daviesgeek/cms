module.exports = function() {
  return {
    restrict: 'C',
    transclude: true,
    scope:{
      confirmHeader: '@confirmHeader',
      confirmBody: '@confirmBody',
      action: '@action',
      idiotTest: '=idiotTest',
      callbackSuccess: '&callbackSuccess',
      callbackError: '&callbackError'
    },
    template: require('../views/directive-epi-confirm-dialog'),
    controller: ['$scope', '$modal', '$log', function($scope, $modal, $log){

      var header = $scope.confirmHeader;
      var body = $scope.confirmBody;
      var idiotTest = $scope.idiotTest;
      var action = $scope.action;
      var callbackSuccess = $scope.callbackSuccess;
      var callbackError = $scope.callbackError;
      

      $scope.open = function() {
        
        var modalInstance = $modal.open({
          templateUrl: '/epi-confirm-dialog.html',
          controller: epiConfirmDialogCtrl
        })

      }

      var epiConfirmDialogCtrl = function($scope, $modalInstance, $log, $sce) {
        $scope.header = header;
        $scope.bodySafe = $sce.trustAsHtml(body);
        $scope.action = action;
        $scope.idiotTest = idiotTest;


        $scope.validate = function(value) {
          if(value == idiotTest)
            return true;
          return false;
        }

        $scope.submit = function(form) {
          if(form){
            callbackSuccess();
            $modalInstance.close();
          }
        }

        $scope.cancel = function() {
          callbackError();
          $modalInstance.dismiss('cancel');
        }
      }

    }],
    link: function(scope) {
    }
  }
}