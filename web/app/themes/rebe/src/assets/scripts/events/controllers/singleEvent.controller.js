/*eslint angular/di: [2,"array"]*/
angular.module('singleEvent.controller', [])
  .controller('SingleEventController', ['$rootScope', '$scope', '$location', '$state', '$stateParams', '$filter', 'lodash', 'ApiService', 'PostSidebarService', 'PostFootnotesService', 'RelatedPostsService', function ($rootScope, $scope, $location, $state, $stateParams, $filter, lodash, ApiService, PostSidebarService, PostFootnotesService, RelatedPostsService) {

  var viewModel = $scope;
  viewModel.event = {};
  viewModel.shareUrl = $location.absUrl();

  ApiService
    .getEvent($stateParams.event)
    .then(function(response) {
      viewModel.event = response;
      viewModel.event.sidebar = PostSidebarService.getSidebarObjects(viewModel.event.sidebar);
      viewModel.event.sources = PostFootnotesService.getSourceContributers(viewModel.event.sources);
      viewModel.event.sources = PostFootnotesService.getResourceContributers(viewModel.event.sources);
      viewModel.event.related_events = RelatedPostsService.getRelatedEvents(viewModel.event.related_events);
      viewModel.event.related_stories = RelatedPostsService.getRelatedStories(viewModel.event.related_stories);
      // Animate once loaded
      // NB! Temporary solution, otherwise we should avoid jQury in angular!
      angular.element('.js-content').fadeIn('fast');
    });

  viewModel.next = function () {
    var currentEvent = lodash.find(viewModel.events, function (event) {
      return event.slug === $stateParams.event;
    });

    var i = lodash.indexOf(viewModel.events, currentEvent);

    if (i === viewModel.events.length) {
      i = 0;
    }

    var nextEvent = viewModel.events[i+1];

    $state.go('timeline.event', { event: nextEvent.slug });
  };

  viewModel.prev = function () {
    var currentEvent = lodash.find(viewModel.events, function (event) {
      return event.slug === $stateParams.event;
    });

    var i = lodash.indexOf(viewModel.events, currentEvent);

    if (i === 0) {
      i = viewModel.events.length;
    }

    var prevEvent = viewModel.events[i-1];

    $state.go('timeline.event', { event: prevEvent.slug });
  };
}]);
