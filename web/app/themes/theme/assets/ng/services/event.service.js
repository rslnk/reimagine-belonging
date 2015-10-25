angular.module('event.service', ['ngLodash'])
  .service('EventService', ['$http','lodash', function ($http, lodash) {
    var convertContributors = function (list) {
      var arr = [];
      var i;
      var l = list.length;
      for (i = 0; i < l; i++) {
        arr.push(list[i].first_name + ' ' + list[i].last_name);
      }
      return arr.join(', ');
    };

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

    this.sources = function (sources) {
      if (sources) {
        sources.map(function (item) {
          if (item.author) {
            item.authors = convertContributors(item.author);
          }

          if (item.editor) {
            item.editors = convertContributors(item.editor);
          }

          if (item.translator) {
            item.translators = convertContributors(item.translator);
          }
        });
      }

      return sources;
    };

    this.resources = function (resources) {
      if (resources) {
        resources.map(function (item) {
          if (item.author) {
            item.authors = convertContributors(item.author);
          }

          if (item.editor) {
            item.editors = convertContributors(item.editor);
          }

          if (item.translator) {
            item.translators = convertContributors(item.translator);
          }
        });
      }

      return resources;
    };

  }]);
