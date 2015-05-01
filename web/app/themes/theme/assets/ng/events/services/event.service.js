angular.module('event.api.service', ['ngLodash'])
  .factory('EventService', ['$http','lodash', function ($http, lodash) {
    return {
      get: function (path) {
        return $http.get('/api/?action=event-data&path='+path).then(function (response) {
          return response.data;
        });
      }
    };
  }]);
