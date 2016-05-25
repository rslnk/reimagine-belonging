angular
  .module('workshops.preview.directive', ['ui.router'])
  .directive('workshopPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      templateUrl:  '/app/themes/rebe/templates/content/post-types/workshop/ng/preview.html',
      link: function (scope, element) {
        //
      }
    };
  });
