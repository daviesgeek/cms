module.exports = function() {
  return {
    restrict: 'C',
    template: require('../views/directive-epi-checkbox'),
    scope: {
      id: '@inputId',
      value: '@value',
      name: '@name',
      label: '@label',
      checked: '=checked',
      model: '=model',
      // user: '=user',
      // username: '@username',
    },
    // controller: function($scope) {
    //   // $scope.user = $scope.$parent.user;
    //   $scope.name = $scope.user.fname + ' ' + $scope.user.lname;
    // },
    link: function(scope, element, attrs) {
      $(this).prev('input:checked').addClass('_checked');

      element.children('label').click(function() {
        $(this).prev('input').toggleClass('_checked');
        if(typeof scope.model != 'undefined'){
          scope.model._checked = this.checked;
        }
        // console.log(scope.model);
        // $(this).toggleClass('_checked')
      })
    }
  }
}