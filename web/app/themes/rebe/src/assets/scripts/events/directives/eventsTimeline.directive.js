/*eslint angular/di: [2,"array"]*/
angular.module('eventsTimeline.directive', [])
  .directive('carousel', function () {
    return {
      restrict: 'E',
      transclude: false,
      link: function (scope, element) {
        scope.initCarousel = function (element) {
          var defaultOptions = {
            touchDrag: false,
            mouseDrag: false,
            navigation: true,
            navigationText: ["prev","next"]
          };
          var customOptions = scope.$eval(angular.element(element).attr('data-options'));
          for (var key in customOptions){
            defaultOptions[key] = customOptions[key];
          }

          var owl = angular.element(element).owlCarousel(defaultOptions);

          angular.element('.js-timeline__next').click(function (e) {
            e.preventDefault();
            owl.trigger('owl.next');
          });

          angular.element('.js-timeline__previous').click(function (e) {
            e.preventDefault();
            owl.trigger('owl.prev');
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
