angular
  .module('stories.preview.directive', ['ui.router'])
  .directive('storyPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      templateUrl:  '/app/themes/rebe/templates/content/post-types/story/ng/preview.html',
      link: function (scope, element) {
        //
      }
    };
  });
