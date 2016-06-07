angular
  .module('events.preview.directive', ['ui.router'])
  .directive('eventPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      templateUrl: '/app/themes/rebe/templates/content/post-types/event/ng/preview.html',
      scope: {
        image: '@',
        title: '@',
        year: '@',
        slug: '@'
      },
      link: function (scope, element, attr) {
        // ! Temporary fix:
        // Large preview images causing data overload,
        // this hack attaches `-250x250` string to the `preview_image` path,
        // this way WP-generated thumbnail is used instad of the original image
        var imgArr = attr.image.split('.');
        imgArr[imgArr.length-2] += '-250x250';
        var previewImgPath = imgArr.join('.');
        element.css('background-image', 'url('+ previewImgPath +')');
      }
    };
  });
