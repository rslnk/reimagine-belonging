angular.module('events.timeline.controller', [
    'events.api.service',
    'events.topics.filter'
  ])
  .controller('TimelineController', [
      '$scope',
      '$http',
      'EventsService',
  function ($scope, $http, EventsService) {

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

    $scope.loadEvents();
  }]);
