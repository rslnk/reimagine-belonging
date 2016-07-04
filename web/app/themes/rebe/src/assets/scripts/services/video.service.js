/*eslint angular/di: [2,"array"]*/
angular.module('video.service', [])
  .factory('VideoService', ['$http', '$log', 'lodash', function ($http, $log, lodash) {

    var service = {
      getVideoURL: getVideoURL
    };
    return service;

    /////////

    function getVideoURL (object) {
      // If video ID is set & URL filed is empty
      // use video id to construct URL
      // This is legacy support of posts where only video ID was provided
      if (object.video_id && !object.video_url) {
        switch (object.video_host) {
          case 'youtube':
            var url = 'https://www.youtube.com/watch?v='+object.video_id;
            return url;
            break;
          case 'vimeo':
            var url = 'https://vimeo.com/'+object.video_id;
            break;
          }
          //$log.log('Using ID! Constructed URL: ' + url);
          return url;
        }
      // Else use data from the video URL field
      else {
        // Get full video url from url field
        // ng-videosharing-embed module will take care of the rest.
        // See: https://github.com/erost/ng-videosharing-embed
        var url = object.video_url;
        //$log.log('Using URL! Fetched URL: ' + url);
        return url;
      }
    };
}]);
