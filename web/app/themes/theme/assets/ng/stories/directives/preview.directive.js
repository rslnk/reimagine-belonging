angular
  .module('stories.preview.directive', ['ui.router'])
  .directive('storyPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="story-preview__item" style="background-image: url({{story.preview_image}})">'+
                  '<div class="color-filter" style="color: {{ color[story.color]}};"></div>'+
                  '<div class="story-preview__content">'+
                    '<h2 class="o-heading c-heading--story-preview">{{ story.title }}</h2>' +
                    '<div class="hero-block">'+
                      '<span class="o-heading c-heading--story-preview">{{ story.hero }}</span>' +
                    '</div>'+
                  '</div>'+
                '</div>',
      link: function (scope, element) {

      }
    };
  });
