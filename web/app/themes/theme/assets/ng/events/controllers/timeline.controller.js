angular.module('events.timeline.controller', [
    'events.api.service',
    'events.events.filter',
    'events.topics.filter'
  ])
  .controller('TimelineController', [
      '$scope',
      '$http',
      '$location',
      'EventsService',
  function ($scope, $http, $location, EventsService) {

    $scope.events = [];
    $scope.config = {};
    $scope.filter = {
      topics: [],
      searchText: ''
    };

    $scope.loadEvents = function () {
      EventsService.get().then(function(response){
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
