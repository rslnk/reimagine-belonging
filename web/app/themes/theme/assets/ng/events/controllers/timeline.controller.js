angular.module('events.timeline.controller', [
    'api.service',
    'events.events.filter',
    'events.topics.filter',
    'ui.router',
    'ngSanitize',
    'ngCookies'
  ])
  .controller('TimelineController', [
    '$scope',
    '$http',
    '$location',
    '$cookies',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
  function ($scope, $http, $location, $cookies, $state, $stateParams, lodash, ApiService) {
    $scope.events = [];
    $scope.config = {};

    $scope.filter = { topics: [], searchText: '' };

    $scope.countries = [
      { name: 'Deutschland', slug: 'deutschland' },
      { name: 'United States', slug: 'united-states' }
    ];

    $scope.timeline = lodash.findWhere($scope.countries, { 
      slug: $stateParams.timeline 
    });

    var delete_cookie = function(name) {
          document.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    };

    var cookieAccess = false;

    if ($cookies.history && !$cookies.history.match('false')) {
      var arr = $cookies.history.split('/');
      if (arr.length > 2){
        cookieAccess = true;
        arr.splice(0,2);
        $location.path(arr.join('/'));
        delete_cookie('history');
      }
    }

    $scope.loadConfig = function () {
      ApiService
        .getConfig()
        .then(function(response) {
          $scope.siteConfig = response;
          if ($stateParams.timeline === '' && cookieAccess === false) {
            $state.go('timeline', { 
              timeline: $scope.siteConfig.default_timeline.slug
            });
          } else {
            $scope.loadEvents();
          }
        });
    };


    $scope.loadEvents = function () {
      ApiService
        .getEvents($stateParams.timeline)
        .then(function(response){
          $scope.events = response;
        });
    };

    $scope.toggleTopicInFilter = function (topic) {
      var i = $scope.filter.topics.indexOf(topic);

      if (i > -1) {
          $scope.filter.topics.splice(i,1);
      } else {
        $scope.filter.topics.push(topic);
      }
    };

    $scope.resetTopicsFilter = function () {
      $scope.filter.topics = [];
    };

    $scope.switchCountry = function (slug) {
      $state.go('timeline', { timeline: slug });
    };

    $scope.openEvent = function (slug) {
      $state.go('timeline.event', { event: slug });
    };

    $scope.$watch('filter.topics', function () {
      $scope.checkTopics();
    }, true);

    $scope.checkTopics = function () {
      if ($scope.filter.topics.length === 0) {
        $location.search('topics', null);
      } else {
        $location.search('topics', $scope.filter.topics.join(','));
      }
    };

    $scope.closeLightbox = function () {
      $state.go('^');
    };

    $scope.loadConfig();

  }]);
