angular.module('stories.list.controller', [
    'api.service',
    'ui.router',
    'ngSanitize',
    'ngCookies'
  ])
  .controller('ListController', [
    '$scope',
    '$http',
    '$location',
    '$cookies',
    '$cookieStore',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
  function ($scope, $http, $location, $cookies, $cookieStore, $state, $stateParams, lodash, ApiService) {
    $scope.stories = [];
    $scope.config = {};

    $scope.filter = { topics: [], searchText: '' };

    var delete_cookie = function(name) {
          document.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    };

    if ($cookies.stories) {
      var arr = $cookies.stories.split('/');
      arr.splice(0,2);
      $location.path(arr.join('/'));
      delete_cookie('stories');
    }

    // var cookies = $cookies.get('stories');

    // console.log( cookies );

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
