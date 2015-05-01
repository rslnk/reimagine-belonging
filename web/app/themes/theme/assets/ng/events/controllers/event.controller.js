angular.module('events.event.controller', [
    'events.api.service',
    'events.events.filter',
    'events.topics.filter',
    'ui.router',
    'ngSanitize'
  ])
  .controller('EventController', [
    '$scope',
    '$http',
    '$location',
    '$state',
    '$stateParams',
    'lodash',
    'EventsService',
  function ($scope, $http, $location, $state, $stateParams, lodash, EventsService) {
    $scope.event = {};

    $scope.loadEvent = function () {
      EventsService
        .getEvent($stateParams.event)
        .then(function(response){
          $scope.event = response;
        });
    };

    $scope.loadEvent();
  }]);
