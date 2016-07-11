/*eslint angular/di: [2,"array"]*/
angular.module('stories.controller', [])
  .controller('StoriesController', ['$rootScope', '$scope', '$location', '$state', '$stateParams', '$filter', 'lodash', 'ApiService', function ($rootScope, $scope, $location, $state, $stateParams, $filter, lodash, ApiService) {

  var viewModel = $scope;

  viewModel.siteConfig = $rootScope.siteConfig;
  viewModel.stories = [];
  viewModel.filter = { topics: [], searchText: '' };
  viewModel.page = 0;
  // Get # of items per page form the stie config
  viewModel.perPage =  viewModel.siteConfig.stories_per_page;

  viewModel.loadConfig = function () {
    ApiService
      .getConfig()
      .then(function(response){
        viewModel.siteConfig = response;
        viewModel.loadStories();
      });
  };

  viewModel.loadConfig();

  viewModel.toggleTopicInFilter = function (topic) {
    viewModel.page = 0;

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

  viewModel.loadStories = function () {
    ApiService
      .getStories()
      .then(function(response){
        viewModel.stories = response;
        // Temporary solution, otherwise we should avoid jQury in angular!
        angular.element('.js-stories-list').fadeIn('slow');
      });
  };

  viewModel.closeLightbox = function () {
    $state.go('^');
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

  viewModel.openStory = function (slug) {
    $state.go('list.story', { story: slug });
  };

  viewModel.getPages = function () {
    var total = $filter('showStories')(viewModel.stories, viewModel.filter).length;
    var pages = Math.ceil(total/viewModel.perPage);
    return new Array( pages );
  };

  viewModel.nextPage = function () {
    viewModel.page += 1;
  };

  viewModel.prevPage = function () {
    viewModel.page -= 1;
  };

  viewModel.toPage = function (page) {
    viewModel.page = page;
  };

  viewModel.inPaginatorScope = function (i) {
    var min = viewModel.page*viewModel.perPage;
    var max = min + viewModel.perPage;
    return (i >= min && i < max);
  };

  viewModel.activePage = function (i) {
    return (i === viewModel.page);
  };
}]);
