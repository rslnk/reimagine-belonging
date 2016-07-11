/*eslint angular/di: [2,"array"]*/
angular.module('relatedPosts.service', [])
  .factory('RelatedPostsService', ['$http', 'lodash', function ($http, lodash) {

    var service = {
      getRelatedEvents: getRelatedEvents,
      getRelatedStories: getRelatedStories
    };
    return service;

    /////////

    function getRelatedEvents (events) {
      if (events) {
        events.map(function (item) {
          // Build path for when related post is queried in another ng app
          // Example: app-base/timeline-name/post-name
          var timelineBase = item.timelines[0].term_slug;
          item.external_slug = '/' + item.app_base + '/' + timelineBase + '/' + item.slug + '/';
        });
      }
      return events;
    };

    function getRelatedStories (stories) {
      if (stories) {
        stories.map(function (item) {
          // Build path for when related post is queried in another ng app
          // Example: app-base/post-name
          item.external_slug = '/' + item.app_base + '/' + item.slug + '/';
        });
      }
      return stories;
    };
}]);
