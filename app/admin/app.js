'use strict'

// if (typeof define !== 'function') {
//     var define = require('amdefine')(module);
// }

// setup configuration
var constants = require('admin/configuration/index');
var config = angular.module('configuration', []);
for(name in constants) {
  config.constant(name, constants[name]);
}

if(constants.ADMIN_ROOT == window.location.pathname){
  require('admin/routes/index');
}else{
  require('admin/routes-edit/index');
}

require('admin/common/index');

angular.module("admin/app", [
  "configuration",
  "ui.router",
  "restangular",
  "app:common",
  "ngAnimate",
  "ui.gravatar",
  "ui.bootstrap",
  "textAngular",
  // routes
  "routes"
]).
config(function($urlRouterProvider, $logProvider, RestangularProvider, API_ROOT){
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

  RestangularProvider.setOnElemRestangularized(function(elem, isCollection, what, Restangular) {
    if(!isCollection)
      return elem;

    /**
     * find an item in a collection by id or other column
     * @param  {int} id
     * @param {string} column
     * @return {object}
     */
    elem.find = function(id, column) {
      if(!column)
        column = 'ID';
      
      for(var i=0; i<elem.length; ++i) {
        if(elem[i][column] == id)
          return elem[i];
      }
    }

    /**
     * returns the index of a ID 
     * @param  {int} id
     * @return {int}
     */
    elem.indexOfID = function(id) {

      for(var i=0; i<elem.length; ++i) {
        if(elem[i].id == id)
          return i;
      }

    }

    return elem;
  });

  $logProvider.debugEnabled(true);
  $urlRouterProvider
    .when('', '/')
    .otherwise("/not-found")
  return
})
.run(function($rootScope, $http){
  $http.defaults.withCredentials = true;
})

.config([
  'gravatarServiceProvider', function(gravatarServiceProvider) {
    gravatarServiceProvider.defaults = {
      size     : 100,
      "default": 'mm'  // Mystery man as default for missing avatars
    };

    // Use https endpoint
    gravatarServiceProvider.secure = true;
  }
])

// Set/get the session data
.run(function($rootScope, Session) {
  Session.fetch(false);  
})