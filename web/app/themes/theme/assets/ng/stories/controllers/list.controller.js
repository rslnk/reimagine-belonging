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
          $scope.siteConfig = response;
          $scope.loadStories();
        });
    };

    $scope.loadConfig();

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

    $scope.loadStories = function () {
      ApiService
        .getStories()
        .then(function(response){
          $scope.stories = response;
        });
    };

    $scope.closeLightbox = function () {
      $state.go('^');
    };

    $scope.openStory = function (slug) {
      $state.go('list.story', { story: slug });
    };

  }]);
