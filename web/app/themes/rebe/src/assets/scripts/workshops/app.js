angular.module('workshopsApp', [
    'ui.router',
    'ngCookies',
    'constants',
    '720kb.socialshare',
    'api.service',
    'workshop.service',
    'workshops.list.controller',
    'workshops.workshop.controller',
    'workshops.preview.directive'
  ])
  .run([
    '$rootScope',
    '$state',
    '$stateParams',
    '$cookies',
    '$location',
    'ApiService',
    'WorkshopService',
    function(
      $rootScope,
      $state,
      $stateParams,
      $cookies,
      $location,
      ApiService,
      WorkshopService
    ){
      $rootScope.$state = $state;
      $rootScope.$stateParams = $stateParams;
    }
  ])
  .config([
    '$stateProvider',
    '$urlRouterProvider',
    '$locationProvider',
    'templatesPath',
    function(
      $stateProvider,
      $urlRouterProvider,
      $locationProvider,
      templatesPath
    ) {
      $locationProvider.html5Mode(true);
      $stateProvider
        .state('list', {
          url: '/',
          templateUrl: templatesPath + 'content/pages/workshops/ng/list.html',
          controller: 'ListController'
        })
        .state('list.workshop', {
          url: ':workshop',
          templateUrl: templatesPath + 'content/post-types/workshop/ng/single.html',
          controller: 'WorkshopController'
        });
    }
  ]);
