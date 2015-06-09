angular
  .module('stories.preview.directive', ['ui.router'])
  .directive('storyPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<div class="story-preview__item" style="background-image: url({{story.preview_image}})">'+
                  '<div class="story-preview__image-overlay story-preview__image-overlay--solid {{ story.preview_image_color }}"></div>' +
                  '<div class="story-preview__content">'+
                    '<div class="story-title">' +
                      '<h2 class="o-heading c-heading--story-preview">{{ story.title }}</h2>' +
                    '</div>' +
                    '<div class="story-hero">'+
                      '<h3><strong>{{ story.hero }}</strong>, {{ story.city[0].term_name }}</h3>' +
                    '</div>'+
                    '<div class="post-format-icon u-icon u-icon-play-negative"></div>' +
                  '</div>'+
                '</div>',
      link: function (scope, element) {

      }
    };
  });
