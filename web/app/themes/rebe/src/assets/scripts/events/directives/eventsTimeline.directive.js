/*eslint angular/di: [2,"array"]*/
angular.module('eventsTimeline.directive', [])
  .directive('timeline', function () {
    return {
      restrict: 'E',
      transclude: false,
      link: function (scope, element) {
        scope.initCarousel = function (element) {
          var defaultOptions = {
            // lazyLoad: true, // needs additional implementation to work with Angular!
            // loop: true,
            responsive: {
              0 : {
                items: 1,
                slideBy: 1
              },
              600 : {
                items: 3,
                slideBy: 3
              },
              1024 : {
                items: 4,
                slideBy: 4
              },
              1200 : {
                items: 5,
                slideBy: 5
              },
              1600 : {
                items: 6,
                slideBy: 6
              },
              1900 : {
                items: 8,
                slideBy: 8
              }
            }
          };
          var customOptions = scope.$eval(angular.element(element).attr('data-options'));
          for (var key in customOptions){
            defaultOptions[key] = customOptions[key];
          }

          // Hooking into owlCarousel navigation in order to use custom prev/next buttons
          var owl = angular.element(element).owlCarousel(defaultOptions);

          angular.element('.js-timeline__previous').click(function (e) {
            e.preventDefault();
            owl.trigger('prev.owl.carousel');
          });

          angular.element('.js-timeline__next').click(function (e) {
            e.preventDefault();
            owl.trigger('next.owl.carousel');
          });

        };
      }
    };
  })
  .directive('timelineItem', function () {
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
