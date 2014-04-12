'use strict';

/**
 * User resource
 */

module.exports = function (Restangular) {
  var User = Restangular.all('users');

  // add a custom methods to collection
  Restangular.addElementTransformer('users', true, function(collection) {
    // don't try to work on uninitialized collection
    if(!('one' in collection))
      return collection;

    collection.addRestangularMethod('search', 'getList', 'search');

    return collection;
  });

  return User;
};