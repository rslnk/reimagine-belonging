angular.module('events.timeline.controller', [
    'events.api.service',
    'events.events.filter',
    'events.topics.filter',
    'ui.router',
    'ngSanitize'
  ])
  .controller('TimelineController', [
    '$scope',
    '$http',
    '$location',
    '$state',
    '$stateParams',
    'lodash',
    'EventsService',
  function ($scope, $http, $location, $state, $stateParams, lodash, EventsService) {
    $scope.events = [];
    $scope.config = {};

    $scope.filter = { topics: [], searchText: '' };

    $scope.countries = [
      { name: 'Germany', slug: 'germany' },
      { name: 'United States', slug: 'united-states' }
    ];

    $scope.timeline = lodash.findWhere($scope.countries, { slug: $stateParams.timeline });

    $scope.loadEvents = function () {
      EventsService
        .get($stateParams.timeline)
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
      if ($scope.filter.topics.length === 0) {
        $location.search('topics', null);
      } else {
        $location.search('topics', $scope.filter.topics.join(','));
      }
    }, true);

    $scope.$watch('filter.searchText', function () {
      if ($scope.filter.searchText === '') {
        $location.search('search', null);
      } else {
        $location.search('search', $scope.filter.searchText);
      }
    }, true);

    $scope.loadEvents();
  }]);
