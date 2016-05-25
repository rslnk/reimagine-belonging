angular.module('workshops.workshop.controller', [
    'api.service',
    'ui.router',
    'ui.router',
    'ngSanitize'
  ])
  .controller('WorkshopController', [
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
    'WorkshopService',
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
    WorkshopService
  ) {
    $scope.workshop = {};

    $scope.trustSrc = function(src) {
      return $sce.trustAsResourceUrl(src);
    };

    ApiService
      .getWorkshop($stateParams.workshop)
      .then(function(response){
        $scope.workshop = response;
        
        // Temporary solution, otherwise we should avoid jQury in angular!
        $('.js-workhop').fadeIn('fast');

        $scope.workshop.sidebar = WorkshopService.sidebar($scope.workshop.sidebar);
        $scope.workshop.related_workshops = WorkshopService.relatedWorkshops($scope.workshop.related_workshops);
        $scope.workshop.related_events = WorkshopService.relatedEvents($scope.workshop.related_events);
        $scope.workshop.related_stories = WorkshopService.relatedStories($scope.workshop.related_stories);
      });

    $scope.shareUrl = $location.absUrl();

    $scope.next = function () {
      var currentWorkshop = lodash.find($scope.workshops, function (workshop) {
        return workshop.slug === $stateParams.workshop;
      });

      var i = lodash.indexOf($scope.workshops, currentWorkshop);

      if (i === $scope.workshops.length) {
        i = 0;
      }

      var nextWorkshop = $scope.workshops[i+1];

      $state.go('list.workshop', { workshop: nextWorkshop.slug });
    };

    $scope.prev = function () {
      var currentWorkshop = lodash.find($scope.workshops, function (workshop) {
        return workshop.slug === $stateParams.workshop;
      });

      var i = lodash.indexOf($scope.workshops, currentWorkshop);

      if (i === 0) {
        i = $scope.workshops.length;
      }

      var prevWorkshop = $scope.workshops[i-1];

      $state.go('list.workshop', { workshop: prevWorkshop.slug });
    };

  }]);
