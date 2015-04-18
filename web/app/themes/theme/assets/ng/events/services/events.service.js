angular.module('events.api.service', [])
  .factory('EventsService', ['$http', function ($http) {
    return {
      get: function () {
        return $http.get('/api/?action=list-all-events').then(function (response) {
          return response.data;
        });
      }
    };
  }]);
