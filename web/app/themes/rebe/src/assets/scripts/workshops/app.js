/*eslint angular/di: [2,"array"]*/
angular.module('workshopsApp', [
  'ui.router',
  'ngLodash',
  'ngSanitize',
  'ngCookies',
  'projectConstants',
  'api.service',
  'workshops.controller',
  'singleWorkshop.controller',
  'workshopPreview.directive',
  'postSidebar.service',
  'relatedPosts.service',
  'video.service',
  'workshops.filter',
  '720kb.socialshare',
  'videosharing-embed'
])
.config(['$stateProvider', '$urlRouterProvider', '$locationProvider', 'templatesPath', function($stateProvider, $urlRouterProvider, $locationProvider, templatesPath) {
  $locationProvider.html5Mode(true);
  $stateProvider
    .state('list', {
      url: '/',
      templateUrl: templatesPath + 'content/pages/workshops/ng/list.html',
      controller: 'WorkshopsController as viewModel',
      controllerAs: 'viewModel'
    })
    .state('list.workshop', {
      url: ':workshop',
      templateUrl: templatesPath + 'content/post-types/workshop/ng/single.html',
      controller: 'SingleWorkshopController as viewModel',
      controllerAs: 'viewModel'
    });
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
  var appBaseSlug = siteConfig.workshops_slug; // get app slug, it equals cookies name
  var theCookie = $cookies.get(appBaseSlug); // get the cookie
  // Check the cookie's value (url) and split it
  if (theCookie && !theCookie.match('false')) {
    var arr = theCookie.split('/');
    // If cookie's splitted value hase more than 2 segments,
    // we assume that it contains single post slug.
    // Remove app slug from the value and update ui-router location path
    if (arr.length > 2 && !theCookie.match('topics')){
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
