angular
  .module('events.carousel.directive', [])
  .directive('carousel', function () {
    return {
      restrict: 'A',
      transclude: false,
      link: function (scope, element, attrs) {
        scope.$watch('filter', function () {
          console.log('xxx');
          scope.initCarousel(element);
        }, true);
        scope.initCarousel = function (element) {
          $(element).itemslide({
            duration: 150
          });
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
