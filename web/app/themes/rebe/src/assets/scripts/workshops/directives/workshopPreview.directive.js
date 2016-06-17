/*eslint angular/di: [2,"array"]*/
angular.module('workshopPreview.directive', [])
  .directive('workshopPreview', ['templatesPath', function (templatesPath) {
    return {
      restrict: 'E',
      replace: true,
      templateUrl:  templatesPath + 'content/post-types/workshop/ng/preview.html',
      link: function (scope, element) {
        //
      }
    };
  }]);
