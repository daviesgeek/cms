/**
 * Admin/index.js (handles all the routing for the admin pages)
 */

angular
    .module('routes:admin', [])
    .controller('admin:init', require('./controllers/admin-init'))
    .controller('admin:users-and-entities', require('./controllers/users-and-entities'))
    .controller('admin:edit-user', require('./controllers/edit-user'))
    .controller('admin:edit-entity', require('./controllers/edit-entity'))
    .controller('admin:edit-entity-permissions', require('./controllers/edit-entity-permissions'))
    .controller('admin:manage', require('./controllers/manage'))
    .controller('admin:billing', require('./controllers/billing'))
    .config(function ($stateProvider) {
      $stateProvider.
        state('admin', {
          url: '/admin',
          template: require('./views/admin-init'),
          controller: 'admin:init'
        })
        .state('admin.users-and-entities', {
          url:'/users-and-entities',
          template: require('./views/users-and-entities'),
          controller: 'admin:users-and-entities',
          resolve: {
            users: function(User) {
              return User.getList();
            },
            entities: function(Entity) {
              return Entity.getList();
            },
            // get a list of all available entity permissions
            permissions: function($q, $http, API_ROOT) {
              var deferred = $q.defer();
              $http({'method': 'GET', 'url': API_ROOT + '/entities/permissions'})
                .success(function(response) {
                  deferred.resolve(response.data);
                });
              return deferred.promise;
            }
          }
        })
        .state('admin.users-and-entities.edit-user', {
          url: '/user/:id',
          template: require('./views/edit-user'),
          controller: 'admin:edit-user'
        })
        .state('admin.users-and-entities.edit-entity', {
          url: '/entity/:id',
          template: require('./views/edit-entity'),
          controller: 'admin:edit-entity'
        })
        .state('admin.users-and-entities.edit-entity-permissions', {
          url: '/edit-entity-permissions/:id',
          template: require('./views/edit-entity-permissions'),
          controller: 'admin:edit-entity-permissions'
        })
        .state('admin.manage', {
          url:'/manage',
          template: require('./views/manage'),
          controller: 'admin:manage'
        })
        .state('admin.billing', {
          url:'/billing',
          template: require('./views/billing'),
          controller: 'admin:billing'
        });
        // .
        // state('notfound', {
        //   url:'/not-found',
        //   template: require('./views/404'),
        //   controller: 'test:404'
        // }); 

    });
