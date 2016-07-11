/*eslint angular/di: [2,"array"]*/
angular.module('eventPreview.directive', [])
  .directive('eventPreview', ['templatesPath', function (templatesPath) {
    return {
      restrict: 'E',
      replace: true,
      templateUrl: templatesPath + 'content/post-types/event/ng/preview.html',
      scope: {
        image: '@',
        title: '@',
        year: '@',
        slug: '@',
        filtered: '@'
      },
      link: function (scope, element, attr) {
        //
      }
    };
}]);
