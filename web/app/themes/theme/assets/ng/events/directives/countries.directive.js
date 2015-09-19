angular
  .module('events.countries.directive', [])
  .directive('countriesSwitcher', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="countries-switcher">'+
                '<h2 class="o-btn c-btn--selector c-btn--mint" ng-click="ctrl.toggle()">' +
                    '{{ timeline.name }}' +
                    '<span class="u-icon u-icon-arrow-down-negative countries-switcher__icon"></span>'+
                '</h2>'+
                '<ul class="countries-switcher__list" ng-show="ctrl.open">'+
                '<li class="o-btn c-btn--medium c-btn--mint" ng-repeat="country in siteConfig.timelines" ng-click="switchCountry(country.slug)">{{ country.name }}</li>'+
                '</ul>'+
                '</div>',
      controller: function ($scope, $element) {
        this.open = false;
        this.toggle = function () {
          this.open = !this.open;
        };
      },
      controllerAs: 'ctrl'
    };
  });
