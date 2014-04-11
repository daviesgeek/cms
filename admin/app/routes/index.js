/**
 * Main index.js module (routing)
 */

require('routes/admin/index');
require('routes/dashboard/index');
require('routes/lists/index');
require('routes/data/index');
require('routes/tools/index');
require('routes/error/index');

angular
	.module('routes', ['routes:admin', 'routes:dashboard', 'routes:lists', 'routes:data', 'routes:tools', 'routes:error'])
	.controller('top-nav', require('./controllers/top-nav'))
	.controller('home', require('./controllers/home'))
	.controller('home-child', require('./controllers/home-child'))
	.controller('test', require('./controllers/test'))
	.config(function($stateProvider) {
		$stateProvider.
			state('init', {
				abstract: true,
				template: require('./views/init'),
			})
			.state('init.home', {
				url: '/',
				template: require('./views/home'),
				controller: 'home',
				resolve: {
					'entities': function($q, $http, API_ROOT) {
						var deferred = $q.defer();
						$http({'method': 'GET', 'url': API_ROOT + '/entities/summary'})
						.then(function(response) {
							response = angular.fromJson(response);
							deferred.resolve(response.data.data);
						});
						return deferred.promise;
					}
				}
			})
			.state('test', {
				url: '/test',
				template: require('./views/test'),
				controller: 'test'
			})
	})