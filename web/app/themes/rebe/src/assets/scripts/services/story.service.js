angular.module('story.service', ['ngLodash'])
  .service('StoryService', ['$http','lodash', function ($http, lodash) {

    // Related events posts
    this.relatedEvents = function (events) {
      if (events) {
        events.map(function (item) {
          if (item.preview_image) {
            // ! Temporary fix:
            // Large preview images causing data overload,
            // this hack attaches `-250x250` string to the `preview_image` path,
            // this way WP-generated thumbnail is used instad of the original image
            var imgArr = item.preview_image.split('.');
            imgArr[imgArr.length-2] += '-250x250';
            item.thumbnail_image = imgArr.join('.');
          }

          // Get year from the Event `start_date`
          item.year = item.start_date.split('/')[0];

          // Build path for when related post is queried in another ng app
          // Example: app-base/timeline-name/post-name
          var timelineBase = item.timelines[0].term_slug;
          item.external_slug = '/' + item.app_base + '/' + timelineBase + '/' + item.slug + '/';
        });
      }

      return events;
    };

    // Related stories posts
    this.relatedStories = function (stories) {
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
