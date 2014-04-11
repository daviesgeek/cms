'use strict'

/**
 * Main routing module
 */

require('routes/users/index');

angular
	.module('routes', ['routes:users'])
	.config(function($stateProvider) {
		$stateProvider
		.state('init', {
			url: '/',
			template: require('./views/init')
		})
	})