angular.module('api.service', ['ngLodash'])
  .factory('ApiService', ['$http','lodash', function ($http, lodash) {
    return {
      getConfig: function () {
        return $http.get('/api/?action=site-configuration').then(function (response) {
          return response.data;
        });
      },
      getEvent: function (path) {
        return $http.get('/api/?action=event-data&path='+path).then(function (response) {
          return response.data;
        });
      },
      get: function (timeline) {
        return $http.get('/api/?action=list-all-events').then(function (response) {
          var result = [];
          var events = response.data;

          lodash.forEach(events, function (event) {
            if( !!lodash.find(event.timelines, { 'term_slug': timeline })) {
              result.push(event);
            }
          });

          result.map(function (event) {
            if (event.permalink) {
              event.slug = event.permalink.split('/').slice(-2,-1)[0];
              event.year = event.start_date.split('/')[0];
            }
          });

          result = lodash.sortBy(result, 'year');

          return result;
        });
      }
    };
  }]);
