angular.module('storiesApp', [
    'ui.router',
    'ngCookies',
    'constants',
    'api.service',
    'story.service',
    'stories.list.controller',
    'stories.story.controller',
    'stories.preview.directive'
  ])
  .run([
    '$rootScope',
    '$state',
    '$stateParams',
    '$cookies',
    '$location',
    'ApiService',
    'StoryService',
    function(
      $rootScope,
      $state,
      $stateParams,
      $cookies,
      $location,
      ApiService,
      StoryService
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
          templateUrl: templatesPath + 'stories/templates/list.html',
          controller: 'ListController'
        })
        .state('list.story', {
          url: ':story',
          templateUrl: templatesPath + 'stories/templates/story.html',
          controller: 'StoryController'
        });
    }
  ]);
