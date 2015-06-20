angular.module('events.event.controller', [
    'api.service',
    'events.events.filter',
    'events.topics.filter',
    'ui.router',
    'ngSanitize'
  ])
  .controller('EventController', [
    '$scope',
    '$http',
    '$sce',
    '$location',
    '$state',
    '$stateParams',
    'lodash',
    'ApiService',
  function ($scope, $http, $sce, $location, $state, $stateParams, lodash, ApiService) {
    $scope.event = {};

    $scope.trustSrc = function(src) {
      return $sce.trustAsResourceUrl(src);
    };

    $scope.loadEvent = function () {
      ApiService
        .getEvent($stateParams.event)
        .then(function(response) {
          $scope.event = response;
          $scope.event.sidebar.map(function (item) {
            if (item.type === 'video' && item.video_host) {
              switch (item.video_host) {
                case 'youtube':
                  item.videoUrl = 'http://www.youtube.com/embed/'+item.id;
                  break;
              }
            }
          });

          $scope.event.related_events.map(function (item) {
            if (item.preview_image) {
              var imgArr = item.preview_image.split('.');
              imgArr[imgArr.length-2] += '-250x250';
              item.previewImgPath = imgArr.join('.');
            }

            var slugArr = item.post_slug.split('/');
            item.slug = slugArr[slugArr.length-2];
          });
        });
    };

    $scope.shareUrl = $location.absUrl();

    $scope.loadEvent();
  }]);
