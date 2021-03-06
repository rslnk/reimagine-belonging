/*eslint angular/di: [2,"array"]*/
angular.module('singleWorkshop.controller', [])
  .controller('SingleWorkshopController', ['$rootScope', '$scope', '$location', '$state', '$stateParams', '$filter', 'lodash', 'ApiService', 'PostSidebarService', function ($rootScope, $scope, $location, $state, $stateParams, $filter, lodash, ApiService, PostSidebarService) {

  var viewModel = $scope;
  viewModel.workshop = {};
  viewModel.absoluteUrl = $location.absUrl();

  ApiService
    .getWorkshop($stateParams.workshop)
    .then(function(response){
      viewModel.workshop = response;
      viewModel.workshop.sidebar = PostSidebarService.getSidebarObjects(viewModel.workshop.sidebar);
      // Animate once loaded
      // NB! Temporary solution, otherwise we should avoid jQury in angular!
      angular.element('.js-workhop').fadeIn('fast');
    });

  viewModel.next = function () {
    var currentWorkshop = lodash.find(viewModel.workshops, function (workshop) {
      return workshop.slug === $stateParams.workshop;
    });

    var i = lodash.indexOf(viewModel.workshops, currentWorkshop);

    if (i === viewModel.workshops.length) {
      i = 0;
    }

    var nextWorkshop = viewModel.workshops[i+1];

    $state.go('list.workshop', { workshop: nextWorkshop.slug });
  };

  viewModel.prev = function () {
    var currentWorkshop = lodash.find(viewModel.workshops, function (workshop) {
      return workshop.slug === $stateParams.workshop;
    });

    var i = lodash.indexOf(viewModel.workshops, currentWorkshop);

    if (i === 0) {
      i = viewModel.workshops.length;
    }

    var prevWorkshop = viewModel.workshops[i-1];

    $state.go('list.workshop', { workshop: prevWorkshop.slug });
  };
}]);
