/*eslint angular/di: [2,"array"]*/
angular.module('events.controller', [])
  .controller('EventsController', ['$rootScope', '$scope', '$sce', '$location', '$state', '$stateParams', 'lodash', 'ApiService', function ($rootScope, $scope, $sce, $location, $state, $stateParams, lodash, ApiService) {

  var viewModel = $scope;

  viewModel.siteConfig = $rootScope.siteConfig;
  // Get timeline slug from the list of timelines set in the Site Configuration
  viewModel.timeline = lodash.find(viewModel.siteConfig.timelines, {
    slug: $stateParams.timeline
  });
  viewModel.events = [];
  viewModel.filter = { topics: [], searchText: '' };

  viewModel.trustSrc = function(src) {
    return $sce.trustAsResourceUrl(src);
  };

  viewModel.loadEvents = function () {
    ApiService
      .getEvents($stateParams.timeline)
      .then(function(response){
        viewModel.events = response;
      });
  };

  viewModel.loadEvents();

  viewModel.toggleTopicInFilter = function (topic) {
    var i = viewModel.filter.topics.indexOf(topic);

    if (i > -1) {
      viewModel.filter.topics.splice(i,1);
    } else {
      viewModel.filter.topics.push(topic);
    }
  };

  viewModel.resetTopicsFilter = function () {
    viewModel.filter.topics = [];
  };

  viewModel.switchTimeline = function (slug) {
    $state.go('timeline', { timeline: slug });
  };

  viewModel.openEvent = function (slug) {
    $state.go('timeline.event', { event: slug });
  };

  viewModel.$watch('filter.topics', function () {
    viewModel.checkTopics();
  }, true);

  viewModel.checkTopics = function () {
    if (viewModel.filter.topics.length === 0) {
      $location.search('topics', null);
    } else {
      $location.search('topics', viewModel.filter.topics.join(','));
    }
  };

  viewModel.closeLightbox = function () {
    $state.go('^');
  };

}]);
