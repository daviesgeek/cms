'use strict'

// setup configuration
var constants = require('admin-edit/configuration/index');
var config = angular.module('configuration', []);
for(name in constants) {
  config.constant(name, constants[name]);
}

require('admin-edit/common/index');
require('admin-edit/routes/index');

angular.module("admin-edit/app", [
  "configuration",
  "restangular",
  "textAngular",
  "ui.router",  
  "routes",
  "app:common"
])
.config(function (RestangularProvider, API_ROOT) {
  // setup Restangular
  RestangularProvider.setBaseUrl(API_ROOT);
  
  RestangularProvider.setRestangularFields({
    id: 'id'
  });

  RestangularProvider.setResponseExtractor(function(response, operation, what, url) {
    var newResponse;
    if(operation == 'getList') {
      newResponse = response.data;
      newResponse.meta = response.meta;
    }
    else
      newResponse = response.data;

    return newResponse;
  });

})
.run(function($rootScope, $http){
  $http.defaults.withCredentials = true;
})