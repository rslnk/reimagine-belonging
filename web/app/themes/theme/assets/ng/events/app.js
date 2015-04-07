angular.module('eventsApp', ['ui.router','eventsApp.constants'])
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
          templateUrl: templatesPath + 'events/templates/timeline.html'
        })
        .state('timeline.event', {
          url: '/:event',
          templateUrl: templatesPath + 'events/templates/timeline.event.html'
        });
    }
  ]);

console.log('xxx');
