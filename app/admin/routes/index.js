'use strict'

/**
 * Main routing module
 */

require('admin/routes/users/index');

angular
	.module('routes', ['routes:users'])
	.config(function($stateProvider) {
		$stateProvider
		.state('init', {
			url: '/',
			template: require('./views/init')
		})
	})