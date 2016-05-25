angular.module('api.service', ['ngLodash'])
  .factory('ApiService', ['$http','lodash', function ($http, lodash) {
    return {
      getConfig: function () {
        return $http.get('/api/?action=site-configuration').then(function (response) {
          return response.data;
        });
      },
      getConfigSync: function () {
        var req = new XMLHttpRequest();
        req.open('GET', '/api/?action=site-configuration', false);
        req.send(null);
        return req;
      },
      getPage: function (path) {
        return $http.get('/api/?action=page-data&path='+path).then(function (response) {
          return response.data;
        });
      },
      getPages: function () {
        return $http.get('/api/?action=list-all-pages').then(function (response) {
          var pages = response.data;

          pages.map(function (page) {
            if (page.permalink) {
              page.slug = page.permalink.split('/').slice(-2,-1)[0];
            }
          });

          return pages;
        });
      },
      getEvent: function (path) {
        return $http.get('/api/?action=event-data&path='+path).then(function (response) {
          return response.data;
        });
      },
      getEvents: function (timeline) {
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
      },
      getStories: function () {
        return $http.get('/api/?action=list-all-stories').then(function (response) {
          var stories = response.data;

          stories.map(function (story) {
            if (story.permalink) {
              story.slug = story.permalink.split('/').slice(-2,-1)[0];
            }
          });

          // result = lodash.sortBy(result, 'published_date_gmt');

          return stories;
        });
      },
      getStory: function (path) {
        return $http.get('/api/?action=story-data&path='+path).then(function (response) {
          return response.data;
        });
      },
      getWorkshops: function () {
        return $http.get('/api/?action=list-all-workshops').then(function (response) {
          var workshops = response.data;

          workshops.map(function (workshop) {
            if (workshop.permalink) {
              workshop.slug = workshop.permalink.split('/').slice(-2,-1)[0];
            }
          });

          // result = lodash.sortBy(result, 'published_date_gmt');

          return workshops;
        });
      },
      getWorkshop: function (path) {
        return $http.get('/api/?action=workshop-data&path='+path).then(function (response) {
          return response.data;
        });
      }
    };
  }]);
