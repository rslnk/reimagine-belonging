/*eslint angular/di: [2,"array"]*/
angular.module('singleStory.controller', [])
  .controller('SingleStoryController', ['$rootScope', '$scope', '$location', '$state', '$stateParams', '$filter', 'lodash', 'ApiService', 'VideoService', 'RelatedPostsService', function ($rootScope, $scope, $location, $state, $stateParams, $filter, lodash, ApiService, VideoService, RelatedPostsService) {

  var viewModel = $scope;
  viewModel.story = {};
  viewModel.absoluteUrl = $location.absUrl();

  ApiService
    .getStory($stateParams.story)
    .then(function(response){
      viewModel.story = response;
      viewModel.story.video_url = VideoService.getVideoURL(viewModel.story);
      viewModel.story.related_events = RelatedPostsService.getRelatedEvents(viewModel.story.related_events);
      viewModel.story.related_stories = RelatedPostsService.getRelatedStories(viewModel.story.related_stories);
      // Animate once loaded
      // NB! Temporary solution, otherwise we should avoid jQury in angular!
      angular.element('.js-content').fadeIn('fast');
    });

  viewModel.next = function () {
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

  viewModel.prev = function () {
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
