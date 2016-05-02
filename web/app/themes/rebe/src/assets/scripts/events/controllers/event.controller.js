angular.module('events.event.controller', [
    'api.service',
    'events.events.filter',
    'events.topics.filter',
    'ui.router',
    'ngSanitize'
  ])
  .controller('EventController', [
    '$rootScope',
    '$scope',
    '$http',
    '$sce',
    '$location',
    '$state',
    '$stateParams',
    '$filter',
    'lodash',
    'ApiService',
    'EventService',
  function (
    $rootScope,
    $scope,
    $http,
    $sce,
    $location,
    $state,
    $stateParams,
    $filter,
    lodash,
    ApiService,
    EventService
  ) {
    $scope.event = {};

    $scope.trustSrc = function(src) {
      return $sce.trustAsResourceUrl(src);
    };

    ApiService
      .getEvent($stateParams.event)
      .then(function(response) {
        $scope.event = response;

        $scope.event.sidebar = EventService.sidebar($scope.event.sidebar);
        $scope.event.related_events = EventService.relatedEvents($scope.event.related_events);
        $scope.event.related_stories = EventService.relatedStories($scope.event.related_stories);
        $scope.event.sources = EventService.sources($scope.event.sources);
        $scope.event.resources = EventService.sources($scope.event.resources);
        
        // Temporary solution, otherwise we should avoid jQury in angular!
        $('.js-content').fadeToggle('fast');
      });

    $scope.shareUrl = $location.absUrl();

    $scope.next = function () {
      var currentEvent = lodash.find($scope.events, function (event) {
        return event.slug === $stateParams.event;
      });

      var i = lodash.indexOf($scope.events, currentEvent);

      if (i === $scope.events.length) {
        i = 0;
      }

      var nextEvent = $scope.events[i+1];

      $state.go('timeline.event', { event: nextEvent.slug });
    };

    $scope.prev = function () {
      var currentEvent = lodash.find($scope.events, function (event) {
        return event.slug === $stateParams.event;
      });

      var i = lodash.indexOf($scope.events, currentEvent);

      if (i === 0) {
        i = $scope.events.length;
      }

      var prevEvent = $scope.events[i-1];

      $state.go('timeline.event', { event: prevEvent.slug });
    };

  }]);
