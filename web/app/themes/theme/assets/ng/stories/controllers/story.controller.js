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

    $scope.loadStory = function () {
      ApiService
        .getStory($stateParams.story)
        .then(function(response){
          $scope.story = response;
          $scope.story.video_url = 'http://vimeo.com/' + $scope.story.story_video_id;

          $('.lightbox').height($('main').height() + 100);
          $('html, body').animate({ scrollTop: 0 }, 200);
        });
    };

    $scope.shareUrl = $location.absUrl();

    $scope.loadStory();
  }]);
