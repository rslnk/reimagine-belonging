angular
  .module('events.dateformat.directive', [])
  .directive('dateformat', function () {
    return {
      restrict: 'E',
      replace: true,
      scope: {
        thedate: '@',
        unknown: '@',
        lang: '@'
      },
      template: '<time>{{ format() }}</time>',
      controller: function ($scope) {
        var months = {
          'EN': ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          'DE': ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        };

        $scope.format = function () {
          if( $scope.unknown === "1" ) {
            return $scope.thedate.split('/')[0];
          } else {
            var date = new Date($scope.thedate);
            var d = date.getDate();
            var m = months[$scope.lang][date.getMonth()];
            var y = date.getFullYear();
            return d + ' ' + m + ', ' + y;
          }
        };
      }
    };
  });
