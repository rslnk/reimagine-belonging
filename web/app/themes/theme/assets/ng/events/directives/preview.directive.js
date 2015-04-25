angular
  .module('events.preview.directive', [])
  .directive('eventPreview', function () {
    return {
      restrict: 'E',
      replace: true,
      template: '<li class="event-preview__item">'+
                  '<span class="event-preview__content">'+
                    '<span class="event-preview__year">{{ year }}</span>' +
                    '<h4 class="event-preview__title">{{ title }}</h4>' +
                  '</span>'+
                '</li>',
      scope: {
        image: '@',
        title: '@',
        year: '@',
        slug: '@'
      },
      link: function (scope, element, attr) {
        element.css('background-image', 'url('+attr.image+')');
      }
    };
  });
