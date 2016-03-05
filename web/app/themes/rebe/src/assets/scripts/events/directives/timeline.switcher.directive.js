angular
  .module('events.timeline.switcher.directive', [])
  .directive('timelineSwitcher', function () {
    return {
      restrict: 'E',
      replace: true,
      templateUrl: '/app/themes/rebe/src/views/ng-apps/events/timeline-switcher.html',
      controller: function ($scope, $element) {
        this.open = false;
        this.toggle = function () {
          this.open = !this.open;
        };
      },
      controllerAs: 'ctrl'
    };
  });
