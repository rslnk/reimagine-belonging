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

    var i = $scope.filter.topics.indexOf(topic);
    if (i > -1) {
      $scope.filter.topics.splice(i,1);
    } else {
      $scope.filter.topics.push(topic);
    }
  };

  viewModel.resetTopicsFilter = function () {
    $scope.filter.topics = [];
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

  $scope.$watch('filter.topics', function () {
    viewModel.checkTopics();
  }, true);

  viewModel.checkTopics = function () {
    if ($scope.filter.topics.length === 0) {
      $location.search('topics', null);
    } else {
      $location.search('topics', $scope.filter.topics.join(','));
    }
  };

  viewModel.openStory = function (slug) {
    $state.go('list.story', { story: slug });
  };

  viewModel.getPages = function () {
    var total = $filter('showStories')($scope.stories, $scope.filter).length;
    var pages = Math.ceil(total/$scope.perPage);
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
    var min = $scope.page*$scope.perPage;
    var max = min + $scope.perPage;
    return (i >= min && i < max);
  };

  viewModel.activePage = function (i) {
    return (i === $scope.page);
  };
}]);
