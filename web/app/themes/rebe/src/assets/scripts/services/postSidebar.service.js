/*eslint angular/di: [2,"array"]*/
angular.module('postSidebar.service', [])
  .factory('PostSidebarService',  ['$http', 'lodash', 'VideoService', function ($http, lodash, VideoService) {

    var service = {
      getSidebarObjects: getSidebarObjects
    };
    return service;

    /////////

    function getSidebarObjects (sidebar) {
      if (sidebar) {
        sidebar.map(function (item) {
          // Video object
          if (item.type === 'video') {
            item.video_url = VideoService.getVideoURL(item);
          }
          // Featured Story object
          if (item.type === 'story') {
            item.video_url = VideoService.getVideoURL(item);
            item.city = item.cities[0].term_name;
            // Build path for when related post is queried in another ng app
            // Example: app-base/post-name
            item.external_slug = '/' + item.app_base + '/' + item.slug + '/';

          }
          // Featured Workshop object
          if (item.type === 'workshop') {
            // Build path for when related post is queried in another ng app
            // Example: app-base/post-name
            item.external_slug = '/' + item.app_base + '/' + item.slug + '/';
          }
        });
      }
      return sidebar;
    };
}]);
