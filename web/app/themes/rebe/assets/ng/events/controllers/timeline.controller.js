angular.module('events.timeline.controller', [
    'api.service',
    'events.events.filter',
    'events.topics.filter',
    'ui.router',
    'ngSanitize',
    'ngCookies'
  ])
  .controller('TimelineController', [
    '$rootScope',
    '$scope',
    '$http',
    '$location',
    '$cookies',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
  function ($rootScope, $scope, $http, $location, $cookies, $state, $stateParams, lodash, ApiService) {
    $scope.siteConfig = $rootScope.config;
    $scope.events = [];

    $scope.filter = { topics: [], searchText: '' };

    $scope.timeline = lodash.findWhere($scope.siteConfig.timelines, {
      slug: $stateParams.timeline
    });

    $scope.loadEvents = function () {
      ApiService
        .getEvents($stateParams.timeline)
        .then(function(response){
          $scope.events = response;
        });
    };

    $scope.loadEvents();

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

  }]);
