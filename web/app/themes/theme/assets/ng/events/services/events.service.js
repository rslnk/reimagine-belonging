angular.module('events.api.service', [])
  .factory('EventsService', ['$http', function ($http) {
    return {
      get: function (timeline) {
        return $http.get('/api/?action=list-all-events').then(function (response) {
          var events = response.data;

          events.map(function (event) {
            if (event.permalink) {
              event.slug = event.permalink.split('/').slice(-2,-1)[0];
            }
          });

          return events;
        });
      }
    };
  }]);
