angular.module('eventsApp', [
    'ui.router',
    'constants', 
    'api.service',
    'events.timeline.controller',
    'events.event.controller',
    'events.preview.directive',
    'events.countries.directive',
    'events.carousel.directive'
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
      $stateProvider
        .state('timeline', {
          url: '/:timeline',
          templateUrl: templatesPath + 'events/templates/timeline.html',
          controller: 'TimelineController'
        })
        .state('timeline.event', {
          url: '/:event',
          templateUrl: templatesPath + 'events/templates/timeline.event.html',
          controller: 'EventController'
        });
    }
  ]);
