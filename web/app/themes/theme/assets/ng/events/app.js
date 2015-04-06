'use strict';

angular.module('eventsApp', ['ui.router'])
  .constant('apiUrl', '/api/')
  // .constant('apiUrl', 'http://reimaginebelonging.dev/api/')
  .run(function($rootScope, $state, $stateParams){
    $rootScope.$state = $state;
    $rootScope.$stateParams = $stateParams;
  })
  .config(function($stateProvider, $urlRouterProvider, $locationProvider) {
    $locationProvider.html5Mode(true);
    $urlRouterProvider.otherwise('/germany');
    $stateProvider
      .state('timeline', {
        url: '/:timeline',
        templateUrl: 'events/templates/timeline.html'
      })
      .state('timeline.event', {
        url: '/:timeline/:event',
        templateUrl: 'events/templates/timeline.event.html'
      });
  });
