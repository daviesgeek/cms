module.exports = function(Restangular) {
  // var entity = new $resource(API_HOST + API_ROOT + '/entities/:id', {id: '@id' });
  var Entity = Restangular.all('entities');

  // add a custom users method
  Restangular.addElementTransformer('entities', false, function(entity) {

    // assign users
    entity.addRestangularMethod('putUsers', 'put', 'users');

    // set permissions
    entity.addRestangularMethod('putPermissions', 'put', 'permissions');

    // get user IDs
    entity.userIDs = function() {
      var IDs = [];
      for(var i=0; i<this.users.length; ++i) {
        IDs.push(this.users[i].ID);
      }

      return IDs;
    }


    entity.userIDsWithout = function(ID) {
      var IDs = [];
      for(var i=0; i<this.users.length; ++i) {
        if(this.users[i].ID != ID)
          IDs.push(this.users[i].ID);
      }

      return IDs;
    }

    return entity;
  });


  // add a custom methods to collection
  Restangular.addElementTransformer('entities', true, function(collection) {
    // don't try to work on uninitialized collection
    if(collection.length == 0)
      return collection;

    collection.addRestangularMethod('search', 'getList', 'search');

    return collection;
  });

  return Entity;
}