/**
 * Common/index.js
 * This is where all the services, resources, directives, etc, are included
 */

angular
  .module('ep:common',['ui.sortable'])
  // .directive('dialog', require('./directives/dialog'))
  .directive('epiCheckbox', require('./directives/epi-checkbox'))
  .directive('epiCheckboxSwitch', require('./directives/epi-checkbox-switch'))
  .directive('epiPaging', require('./directives/epi-paging'))
  .directive('epiConfirmDialog', require('./directives/epi-confirm-dialog'))
  .animation('.slide-up', require('./animations/slide-toggle'))
  .animation('.slide-left-closed', require('./animations/slide-left'))
  .animation('.slide-right-closed', require('./animations/slide-right'))
  .animation('.scroll-top', require('./animations/scroll-top'))
  .filter('capitalize', require('./filters/capitalize'))
  .factory('User', require('./resources/user'))
  .factory('Entity', require('./resources/entity'))
  .factory('Group', require('./resources/group'))
  .factory('Session', require('./services/session'))
  .config(function($httpProvider){
    var interceptor = ['$rootScope', '$location', '$q', '$injector', function($rootScope, $location, $q, $injector) {
      return{
        'request': function(config){
          return config;
        },
        'response': function(response){
          return response;
        },
        'responseError': function(response){
          if(response.data.status.code == 422)
            return;
          $rootScope.errors = response.data;
          $injector.get('$state').go('error.generic', [], {location: false});
          return $q.reject(response);
        }
      }
    }];

    $httpProvider.interceptors.push(interceptor);

    // $httpProvider.interceptors.push(function(interceptor) {
    //   console.log(interceptor)
    //   return {
    //    'request': function(config) {
    //        // var $root = angular.element("#view").scope();
    //        // $root.globalMessage = false;
    //        // $root.networkActive = {title:'One moment...'}
    //        return config;
    //     },
     
    //     'response': function(response) {
    //        // var $root = angular.element("#view").scope();
    //        // $root.networkActive = false;
    //        return response;
    //     },
    //     'responseError': httpInterceptor.responseError
    //   };
    // });
  })
