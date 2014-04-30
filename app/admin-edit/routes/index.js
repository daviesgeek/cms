'use strict'

/**
 * Main routing module
 */

angular
	.module('routes', [])
  .controller('main', require('./controllers/main'))
	.config(function($stateProvider, $urlRouterProvider, $logProvider) {
    $logProvider.debugEnabled(true);

    $urlRouterProvider
      .when('', '/')

		$stateProvider
		.state('init', {
      url: '/',
      controller: 'main'
		})
	})