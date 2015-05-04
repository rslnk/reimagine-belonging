angular.module('events.event.controller', [
    'api.service',
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
    'ApiService',
  function ($scope, $http, $location, $state, $stateParams, lodash, ApiService) {
    $scope.event = {};

    $scope.loadEvent = function () {
      ApiService
        .getEvent($stateParams.event)
        .then(function(response){
          $scope.event = response;
        });
    };

    $scope.shareUrl = $location.absUrl();

    $scope.loadEvent();
  }]);
