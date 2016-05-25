angular.module('workshops.list.controller', [
    'api.service',
    'ui.router',
    'ngSanitize',
    'ngCookies',
    'workshops.list.filter',
  ])
  .controller('ListController', [
    '$scope',
    '$filter',
    '$http',
    '$location',
    '$cookies',
    '$cookieStore',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
  function ($scope, $filter, $http, $location, $cookies, $cookieStore, $state, $stateParams, lodash, ApiService) {
    $scope.workshops = [];
    $scope.config = {};

    $scope.page = 0;
    $scope.perPage = 4;

    $scope.filter = { topics: [], searchText: '' };

    var delete_cookie = function(name) {
          document.cookie = name + '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    };

    if ($cookies.workshops && !$cookies.workshops.match('false')) {
      var arr = $cookies.workshops.split('/');
      if (arr.length > 2 && !$cookies.workshops.match('topics')){
        arr.splice(0,2);
        $location.path(arr.join('/'));
      } else {
        $location.path();
      }
      delete_cookie('workshops');
    }

    $scope.loadConfig = function () {
      ApiService
        .getConfig()
        .then(function(response){
          $scope.siteConfig = response;
          $scope.loadWorkshops();
        });
    };

    $scope.loadConfig();

    $scope.toggleTopicInFilter = function (topic) {
      $scope.page = 0;

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

    $scope.loadWorkshops = function () {
      ApiService
        .getWorkshops()
        .then(function(response){
          $scope.workshops = response;
          // Temporary solution, otherwise we should avoid jQury in angular!
          $('.js-workshops-list').fadeIn('slow');
        });
    };

    $scope.closeLightbox = function () {
      $state.go('^');
    };

    $scope.$watch('filter.topics', function () {
      $scope.checkTopics();
    }, true);

    $scope.checkTopics = function () {
      if ($scope.filter.topics.length === 0) {
        $location.search('topics', null);
      } else {
        $location.search('topics', $scope.filter.topics.join(','));
      }
    };

    $scope.openWorkshop = function (slug) {
      $state.go('list.workshop', { workshop: slug });
    };

    $scope.getPages = function () {
      var total = $filter('showWorkshops')($scope.workshops, $scope.filter).length;
      var pages = Math.ceil(total/$scope.perPage);
      return new Array( pages );
    };

    $scope.nextPage = function () {
      $scope.page += 1;
    };

    $scope.prevPage = function () {
      $scope.page -= 1;
    };

    $scope.toPage = function (page) {
      $scope.page = page;
    };

    $scope.inPaginatorScope = function (i) {
      var min = $scope.page*$scope.perPage;
      var max = min + $scope.perPage;
      return (i >= min && i < max);
    };

    $scope.activePage = function (i) {
      return (i === $scope.page);
    };

  }]);
