angular.module('stories.list.controller', [
    'api.service',
    'ui.router',
    'ngSanitize'
  ])
  .controller('ListController', [
    '$scope',
    '$http',
    '$location',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
  function ($scope, $http, $location, $state, $stateParams, lodash, ApiService) {
    $scope.stories = [];
    $scope.config = {};

    $scope.filter = { topics: [], searchText: '' };

    $scope.loadConfig = function () {
      ApiService
        .getConfig()
        .then(function(response){
          console.log( response );
        });
    };

    $scope.loadConfig();
  }]);
