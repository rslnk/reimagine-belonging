/*eslint angular/di: [2,"array"]*/
angular.module('api.service', [])
  .factory('ApiService', ['$http', 'lodash', function ($http, lodash) {

    var service = {
      getConfigSync: getConfigSync,
      getConfig: getConfig,
      getPage: getPage,
      getPages: getPages,
      getEvent: getEvent,
      getEvents: getEvents,
      getStories: getStories,
      getStory: getStory,
      getWorkshops: getWorkshops,
      getWorkshop: getWorkshop
    };
    return service;

    /////////

    // NB! Synchronious XMLHttpRequest throws deprication error. Consider using Angular promise.
    // See: http://stackoverflow.com/questions/16286605/angularjs-initialize-service-with-asynchronous-data
    // Also see: http://blog.brunoscopelliti.com/angularjs-promise-or-dealing-with-asynchronous-requests-in-angularjs/
    function getConfigSync () {
      var req = new XMLHttpRequest();
      req.open('GET', '/api/?action=site-configuration', false);
      req.send(null);
      return req;
    };

    function getConfig () {
      return $http.get('/api/?action=site-configuration').then(function (response) {
        return response.data;
      });
    };

    function getPage (path) {
      return $http.get('/api/?action=page-data&path='+path).then(function (response) {
        return response.data;
      });
    };

    function getPages () {
      return $http.get('/api/?action=list-all-pages').then(function (response) {
        var pages = response.data;

        pages.map(function (page) {
          if (page.permalink) {
            page.slug = page.permalink.split('/').slice(-2,-1)[0];
          }
        });
        return pages;
      });
    };

    function getEvents (timeline) {
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
    };

    function getEvent (path) {
      return $http.get('/api/?action=event-data&path='+path).then(function (response) {
        return response.data;
      });
    };

    function getStories () {
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
    };

    function getStory (path) {
      return $http.get('/api/?action=story-data&path='+path).then(function (response) {
        return response.data;
      });
    };

    function getWorkshops () {
      return $http.get('/api/?action=list-all-workshops').then(function (response) {
        var workshops = response.data;

        workshops.map(function (workshop) {
          if (workshop.permalink) {
            workshop.slug = workshop.permalink.split('/').slice(-2,-1)[0];
          }
        });
        return workshops;
      });
    };

    function getWorkshop (path) {
      return $http.get('/api/?action=workshop-data&path='+path).then(function (response) {
        return response.data;
      });
    };
}]);
