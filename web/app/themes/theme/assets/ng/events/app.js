angular.module('eventsApp', [
    'ui.router',
    'events.constants', 
    'events.api.service',
    'events.timeline.controller',
    'events.preview.directive'
  ])
  .run([
    '$rootScope', 
    '$state', 
    '$stateParams', 
    function($rootScope, $state, $stateParams){
      $rootScope.$state = $state;
      $rootScope.$stateParams = $stateParams;
    }
  ])
  .config([
    '$stateProvider', 
    '$urlRouterProvider', 
    '$locationProvider',
    'templatesPath', 
    function($stateProvider, $urlRouterProvider, $locationProvider, templatesPath) {
      $locationProvider.html5Mode(true);
      $urlRouterProvider.when('/','/germany');
      $stateProvider
        .state('timeline', {
          url: '/:timeline',
          templateUrl: templatesPath + 'events/templates/timeline.html',
          controller: 'TimelineController'
        })
        .state('timeline.event', {
          url: '/:event',
          templateUrl: templatesPath + 'events/templates/timeline.event.html'
        });
    }
  ]);
