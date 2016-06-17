/*eslint angular/di: [2,"array"]*/
angular.module('storyPreview.directive', [])
  .directive('storyPreview', ['templatesPath', function (templatesPath) {
    return {
      restrict: 'E',
      replace: true,
      templateUrl:  templatesPath + 'content/post-types/story/ng/preview.html',
      link: function (scope, element) {
        //
      }
    };
}]);
