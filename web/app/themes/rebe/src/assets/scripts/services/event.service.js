angular.module('event.service', ['ngLodash'])
  .service('EventService', ['$http','lodash', function ($http, lodash) {

    // Convert article/book/etc contributors names
    // for Event post sources and resources
    var convertContributors = function (list) {
      var arr = [];
      var i;
      var l = list.length;
      for (i = 0; i < l; i++) {
        arr.push(list[i].first_name + ' ' + list[i].last_name);
      }
      return arr.join(', ');
    };

    // Sidebar
    this.sidebar = function (sidebar) {
      if (sidebar) {
        sidebar.map(function (item) {
          // Switch YouTube/Vimeo embeded code for sidebar video
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
          if (item.type === 'story') {
            // Construct related story video url
            switch (item.story_video_host) {
              case 'youtube':
                item.videoUrl = 'http://www.youtube.com/embed/'+item.story_video_id+'?title=0&byline=0';
                break;
              case 'vimeo':
                item.videoUrl = 'https://player.vimeo.com/video/'+item.story_video_id+'?title=0&byline=0';
                break;
            }

            // Get first city name from the Story `cities` taxononmy terms
            item.city = item.cities[0].term_name;

            // Build path for when related post is queried in another ng app
            // Example: app-base/post-name
            item.external_slug = '/' + item.app_base + '/' + item.slug + '/';

          }
          
          if (item.type === 'workshop') {
            // Build path for when related post is queried in another ng app
            // Example: app-base/post-name
            item.external_slug = '/' + item.app_base + '/' + item.slug + '/';

          }

        });
      }

      return sidebar;
    };

    // Convert contributors' names for Event sources
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

    // Convert contributors' names for Event resources
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
