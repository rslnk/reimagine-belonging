angular.module('stories.story.controller', [
    'api.service',
    'ui.router',
    'ui.router',
    'ngSanitize'
  ])
  .controller('StoryController', [
    '$rootScope',
    '$scope',
    '$http',
    '$sce',
    '$location',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
    'StoryService',
  function (
    $rootScope,
    $scope,
    $http,
    $sce,
    $location,
    $state,
    $stateParams,
    lodash,
    ApiService,
    StoryService
  ) {
    $scope.story = {};

    $scope.trustSrc = function(src) {
      return $sce.trustAsResourceUrl(src);
    };

    ApiService
      .getStory($stateParams.story)
      .then(function(response){
        $scope.story = response;

        $scope.story.video_url = 'http://vimeo.com/' + $scope.story.story_video_id;
        $scope.story.related_events = StoryService.relatedEvents($scope.story.related_events);
        $scope.story.related_stories = StoryService.relatedStories($scope.story.related_stories);

        // Temporary jquery solution
        // - Sets lightbox height
        // - Moves body content up when lightbox content is called
        // - Lightbox height on window resize function is set in `scripts/main.js`
        //$('.js-lightbox').height($('main').height() + 100);
        $('html, body').animate({ scrollTop: 0 }, 200);
      });

    $scope.shareUrl = $location.absUrl();

    $scope.next = function () {
      var currentStory = lodash.find($scope.stories, function (story) {
        return story.slug === $stateParams.story;
      });

      var i = lodash.indexOf($scope.stories, currentStory);

      if (i === $scope.stories.length) {
        i = 0;
      }

      var nextStory = $scope.stories[i+1];

      $state.go('list.story', { story: nextStory.slug });
    };

    $scope.prev = function () {
      var currentStory = lodash.find($scope.stories, function (story) {
        return story.slug === $stateParams.story;
      });

      var i = lodash.indexOf($scope.stories, currentStory);

      if (i === 0) {
        i = $scope.stories.length;
      }

      var prevStory = $scope.stories[i-1];

      $state.go('list.story', { story: prevStory.slug });
    };

  }]);
