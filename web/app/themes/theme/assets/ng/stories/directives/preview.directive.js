angular
  .module('stories.preview.directive', ['ui.router'])
  .directive('storyPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="story-preview__item" style="background-image: url({{story.preview_image}})">'+
                  '<span class="story-preview__content">'+
                    '<p class="">{{ story.title }}</p>' +
                  '</span>'+
                '</div>',
      link: function (scope, element) {

      }
    };
  });
