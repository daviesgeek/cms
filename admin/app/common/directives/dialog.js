// This directive handles the dialog generation

module.exports = function ($location) {

    return {

        // restrict to attribute only (simply add the `dialog` attribute to any item)
        restrict: 'A',

        // load the jade tmemplate
        template: require('../views/directive-dialog'),

        // setup scope items (I don't know whether I'll use this yet... but this is where you'd set the size or something)
        // scope: { },

        // replaces the original element
        replace:true,

        // copies the original element to the inside of the dialog html
        transclude:true,

        // essentially a "ready" function on the newly created element. I'm not sure if this is the right place
        // to put the scope function... but it works for now.
        controller: function ($scope) {
            // $scope.networkActive = {title:'One moment...'};
            if(!$scope.$parent.closeDialog) {
                $scope.$parent.closeDialog = function() {
                    $location.path('/'); // I'm not sure if there needs to be additional garbage collection here for the directive objects or whether they get destroyed with the element.
                };
            }
        },
        link: function ($scope, element) {
            // $(angular.element(element)).find('select.custom-dropdown').customDropdown();
        }
    };
};
