/*eslint angular/di: [2,"array"]*/
angular.module('eventsApp', [
  'ui.router',
  'ngLodash',
  'ngSanitize',
  'ngCookies',
  'projectConstants',
  'api.service',
  'events.controller',
  'singleEvent.controller',
  'eventsTimeline.directive',
  'eventPreview.directive',
  'dateFormat.directive',
  'postSidebar.service',
  'postFootnotes.service',
  'relatedPosts.service',
  'video.service',
  'events.filter',
  'topics.filter',
  '720kb.socialshare',
  'videosharing-embed'
])
.config(['$stateProvider', '$sceDelegateProvider', '$urlRouterProvider', '$locationProvider', 'templatesPath', function($stateProvider, $sceDelegateProvider, $urlRouterProvider, $locationProvider, templatesPath) {
  $locationProvider.html5Mode(true);
  $stateProvider
    .state('timeline', {
      url: '/:timeline',
      templateUrl: templatesPath + 'content/pages/events/ng/list.html',
      controller: 'EventsController as viewModel',
      controllerAs: 'viewModel'
    })
    .state('timeline.event', {
      url: '/:event',
      templateUrl: templatesPath + 'content/post-types/event/ng/single.html',
      controller: 'SingleEventController as viewModel',
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
  // We need to initialize Site Config before anything else is loaded!
  var reqConfig = ApiService.getConfigSync();
  if (reqConfig.status === 200) {
    $rootScope.siteConfig = angular.fromJson(reqConfig.response);
  }

  // Update app path requests using cookie's value
  var siteConfig = $rootScope.siteConfig; // get Site Config data
  var appBaseSlug = siteConfig.events_slug; // get app slug, it equals cookies name
  var timelineSlug = siteConfig.default_timeline.slug; // get default timeline slug
  var theCookie = $cookies.get(appBaseSlug); // get the cookie
  // Check the cookie's value (url) and split it
  if (theCookie && !theCookie.match('false')) {
    var arr = theCookie.split('/');
    // If cookie's splitted value hase more than 2 segments,
    // we assume that it contains single post slug.
    // Remove app slug from the value and update ui-router location
    if (arr.length > 2 && !theCookie.match('topics')){
      arr.splice(0,2);
      $location.path(arr.join('/'));
      // Delete cookie
      $document[0].cookie = appBaseSlug + '=;path=/;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
    }
  }
  // Otherwise set ui-router location path to app base
  else {
    // Yet check default timeline slug and attach it to the app base
    // i.e. '/events/<united-states>'.
    if($location.path() === '/') {
      $location.path('/' + timelineSlug);
    }
  }
}]);
