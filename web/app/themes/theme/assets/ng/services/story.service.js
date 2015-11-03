angular.module('story.service', ['ngLodash'])
  .service('StoryService', ['$http','lodash', function ($http, lodash) {

    this.relatedEvents = function (events) {
      if (events) {
        events.map(function (item) {
          if (item.preview_image) {
            var imgArr = item.preview_image.split('.');
            imgArr[imgArr.length-2] += '-250x250';
            item.previewImgPath = imgArr.join('.');
          }

          var slugArr = item.post_slug.split('/');
          item.slug = slugArr[slugArr.length-2];
        });
      }

      return events;
    };

    this.relatedStories = function (stories) {
      if (stories) {
        stories.map(function (item) {
          if (item.preview_image) {
            var imgArr = item.preview_image.split('.');
            imgArr[imgArr.length-2] += '-250x250';
            item.previewImgPath = imgArr.join('.');
          }

          var slugArr = item.post_slug.split('/');
          item.slug = slugArr[slugArr.length-2];
        });
      }

      return stories;
    };

  }]);
