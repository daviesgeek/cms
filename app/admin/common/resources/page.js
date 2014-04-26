'use strict';

/**
 * Page resource
 */

module.exports = function (Restangular) {
  var Page = Restangular.all('pages');

  Restangular.extendModel('data/groups', function(collection){
    if(('one' in collection))
      return;

  });
  
  return Page;
}