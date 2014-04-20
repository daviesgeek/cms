'use strict'

/**
 * Main routing module
 */

require('admin/routes/users/index');
require('admin/routes/pages/index');

angular
	.module('routes', ['routes:users', 'routes:pages'])
  .controller('navigation', require('./controllers/navigation'))
  .controller('home', require('./controllers/home'))
	.config(function($stateProvider) {
		$stateProvider
		.state('init', {
			abstract: true,
			template: require('./views/init')
		})
    .state('home', {
      url: '/',
      template: require('./views/home'),
      controller: 'home'
    })
	})