/*eslint angular/di: [2,"array"]*/
angular.module('dateFormat.directive', [])
  .directive('dateFormat', ['templatesPath', function (templatesPath) {
    return {
      restrict: 'E',
      replace: true,
      templateUrl: templatesPath + 'partials/ng/date.html',
      scope: {
        eventdate: '@',
        notexact: '@',
        sitelanguage: '@'
      },
      link: function ($scope) {
        var months = {
          'en_US': ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
          'de_DE': ['Januar', 'Februar', 'March', 'April', "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember "],
        };

        $scope.getEventYearOrFullDate = function () {
          // Check if the exact date set to `unknown`
          // If true, split date and return only year
          if($scope.notexact === "1") {
            return $scope.eventdate.split('/')[0];
          } else {
            // Otherwise construct full human-readable date in `d M y` format (i.e. 7 November, 1917)
            // Use `site_language` settings from Site Config to determine date format and translation of the monts
            var date = new Date($scope.eventdate);
            var d = date.getDate();
            var m = months[$scope.sitelanguage][date.getMonth()];
            var y = date.getFullYear();
          }
          // Output US date format
          if($scope.sitelanguage == "en_US") {
            return m + ' ' + d + ', ' + y;
          }
          // Output EU date format
          else {
            return d + ' ' + m + ', ' + y;
          }
        };
      }
    };
}]);
