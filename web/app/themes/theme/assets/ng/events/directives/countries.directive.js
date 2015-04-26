angular
  .module('events.countries.directive', [])
  .directive('countriesSwitcher', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="countries-switcher">'+
                '<h2 ng-click="ctrl.toggle()">{{ timeline.name }}</h2>'+
                '<ul class="countries-switcher__list" ng-show="ctrl.open">'+
                '<li ng-repeat="country in countries" ng-click="switchCountry(country.slug)">{{ country.name }}</li>'+
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
