angular
  .module('stories.preview.directive', ['ui.router'])
  .directive('storyPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="story-preview__item" style="background-image: url({{story.preview_image}})">'+
                  '<span class="story-preview__content">'+
                    '<h4 class="story-preview__title o-heading c-heading--story-preview">{{ story.title }}</h4>' +
                  '</span>'+
                '</div>',
      link: function (scope, element) {

      }
    };
  });
