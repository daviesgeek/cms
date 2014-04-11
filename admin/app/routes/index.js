/**
 * Main index.js module (routing)
 */

angular
	.module('routes', [])
	.config(function($stateProvider) {
		$stateProvider
		.state('init', {
			url: '/',
			template: require('./views/init')
			// controller: 'top-nav',
		})
		.state('home', {
			url: '/home',
			template: require('./views/home')
		})
	})