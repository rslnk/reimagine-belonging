angular.module('stories.story.controller', [
    'api.service',
    'ui.router',
    'ngSanitize'
  ])
  .controller('StoryController', [
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
        .getStory($stateParams.event)
        .then(function(response){
          $scope.story = response;
        });
    };

    $scope.loadStory();
  }]);
