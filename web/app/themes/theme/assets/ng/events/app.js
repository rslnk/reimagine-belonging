angular.module('eventsApp', [
    'ui.router',
    'ngCookies',
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
    '$cookies',
    '$location',
    'ApiService',
    function($rootScope, $state, $stateParams, $cookies, $location, ApiService){
      $rootScope.$state = $state;
      $rootScope.$stateParams = $stateParams;

      var reqConfig = ApiService.getConfigSync();
      if (reqConfig.status === 200) {
        $rootScope.config = angular.fromJson(reqConfig.response);
      }

      var delete_cookie = function(name) {
        document.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
      };

      if ($cookies.history && !$cookies.history.match('false')) {
        var arr = $cookies.history.split('/');
        if (arr.length > 2){
          arr.splice(0,2);
          $location.path(arr.join('/'));
          delete_cookie('history');
        }
      } else {
        if( $location.path() === '/') {
          $location.path('/'+$rootScope.config.default_timeline.slug);
        }
      }

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
