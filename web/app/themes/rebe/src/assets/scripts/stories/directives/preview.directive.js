angular
  .module('stories.preview.directive', ['ui.router'])
  .directive('storyPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      templateUrl:  '/app/themes/rebe/src/views/ng-apps/stories/preview.html',
      link: function (scope, element) {
        // 
      }
    };
  });
