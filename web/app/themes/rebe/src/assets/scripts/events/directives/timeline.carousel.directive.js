angular
  .module('events.timeline.carousel.directive', [])
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
          var customOptions = scope.$eval($(element).attr('data-options'));
          for (var key in customOptions){
            defaultOptions[key] = customOptions[key];
          }

          var owl = $(element).owlCarousel(defaultOptions);

          $('.js-timeline__next').click(function (e) {
            e.preventDefault();
            owl.trigger('owl.next');
          });

          $('.js-timeline__previous').click(function (e) {
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
