angular.module('workshop.service', ['ngLodash'])
  .service('WorkshopService', ['$http','lodash', function ($http, lodash) {

    // Switch YouTube/Vimeo embeded code for sidebar video
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

  }]);
