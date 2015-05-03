angular
  .module('events.carousel.directive', [])
  .directive('carousel', function () {
    return {
      restrict: 'E',
      transclude: false,
      link: function (scope, element) {
        scope.initCarousel = function (element) {
          var defaultOptions = {};
          var customOptions = scope.$eval($(element).attr('data-options'));
          for (var key in customOptions){
            defaultOptions[key] = customOptions[key];
          }
          $(element).owlCarousel(defaultOptions);
        };
      }
    };
  })
  .directive('carouselItem', function () {
    return {
        restrict: 'A',
        transclude: false,
        link: function (scope, element) {
          if (scope.$last) {
            scope.initCarousel(element.parent());
          }
        }
    };
  });
