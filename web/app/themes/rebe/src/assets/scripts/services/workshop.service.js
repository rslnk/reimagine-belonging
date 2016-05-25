angular.module('workshop.service', ['ngLodash'])
  .service('WorkshopService', ['$http','lodash', function ($http, lodash) {

    this.sidebar = function (sidebar) {
      if (sidebar) {
        sidebar.map(function (item) {
          if (item.type === 'video' && item.video_host) {
            switch (item.video_host) {
              case 'youtube':
                item.videoUrl = 'http://www.youtube.com/embed/'+item.id+'?modestbranding=0&nologo=1&iv_load_policy=3&autoplay=0&showinfo=0&controls=1&cc_load_policy=1&rel=0';
                break;
              case 'vimeo':
                item.videoUrl = 'https://player.vimeo.com/video/'+item.id+'?title=0&byline=0';
                break;
            }
          }
        });
      }

      return sidebar;
    };

    this.relatedWorkshops = function (workshops) {
      if (workshops) {
        workshops.map(function (item) {
          if (item.preview_image) {
            var imgArr = item.preview_image.split('.');
            imgArr[imgArr.length-2] += '-250x250';
            item.previewImgPath = imgArr.join('.');
          }

          item.slug = item.post_slug;

        });
      }

      return workshops;
    };

    this.relatedEvents = function (events) {
      if (events) {
        events.map(function (item) {
          if (item.preview_image) {
            var imgArr = item.preview_image.split('.');
            imgArr[imgArr.length-2] += '-250x250';
            item.previewImgPath = imgArr.join('.');
          }
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
        });
      }

      return stories;
    };

  }]);
