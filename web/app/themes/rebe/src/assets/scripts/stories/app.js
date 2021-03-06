/*eslint angular/di: [2,"array"]*/
angular.module('storiesApp', [
  'ui.router',
  'ngLodash',
  'ngSanitize',
  'ngCookies',
  'projectConstants',
  'api.service',
  'stories.controller',
  'singleStory.controller',
  'storyPreview.directive',
  'relatedPosts.service',
  'video.service',
  'stories.filter',
  '720kb.socialshare',
  'videosharing-embed'
])
.config(['$stateProvider', '$sceDelegateProvider', '$urlRouterProvider', '$locationProvider', 'templatesPath', function($stateProvider, $sceDelegateProvider, $urlRouterProvider, $locationProvider, templatesPath) {
  $locationProvider.html5Mode(true);
  $stateProvider
    .state('list', {
      url: '/',
      templateUrl: templatesPath + 'content/pages/stories/ng/list.html',
      controller: 'StoriesController as viewModel',
      controllerAs: 'viewModel'
    })
    .state('list.story', {
      url: ':story',
      templateUrl: templatesPath + 'content/post-types/story/ng/single.html',
      controller: 'SingleStoryController as viewModel',
      controllerAs: 'viewModel'
    });
    $sceDelegateProvider.resourceUrlWhitelist([
      // Allow same origin resource loads.
      'self',
      // Allow loading from our assets domain. Notice the difference between * and **.
      'http://cdn*.reimaginebelonging.org/**',
      'http://cdn*.reimaginebelonging.de/**'
    ]);
}])
.run(['$rootScope', '$document', '$state', '$stateParams', '$cookies', '$location', 'ApiService', function ($rootScope, $document, $state, $stateParams, $cookies, $location, ApiService){
  $rootScope.$state = $state;
  $rootScope.$stateParams = $stateParams;

  // Synchronious call to Site Configuration API
  // We need to load Site Config before anything else!
  var reqConfig = ApiService.getConfigSync();
  if (reqConfig.status === 200) {
    $rootScope.siteConfig = angular.fromJson(reqConfig.response);
  }

  // Update app path requests using cookie's value
  var siteConfig = $rootScope.siteConfig; // get Site Config data
  var appBaseSlug = siteConfig.stories_slug; // get app slug, it equals cookies name
  var theCookie = $cookies.get(appBaseSlug); // get the cookie
  // Check the cookie's value (url) and split it
  if (theCookie && !theCookie.match('false')) {
    var arr = theCookie.split('/');
    // If cookie's splitted value hase more than 2 segments,
    // we assume that it contains single post slug.
    // Remove app slug from the value and update ui-router location path
    if (arr.length > 2 && !theCookie.match('topics')) {
      arr.splice(0,2);
      $location.path(arr.join('/'));
    }
    // Otherwise set ui-router location path to app base
    else {
      $location.path();
    }
    // Delete cookie
    $document[0].cookie = appBaseSlug + '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  }
}])
