module.exports = function(Restangular) {
  var Group = Restangular.all('data/groups');

  Restangular.addElementTransformer('data/groups', true, function(collection){
    if (collection.length == 0)
      return collection;

    collection.addRestangularMethod('create', 'post');
    
    return collection;
  })

  return Group;
}