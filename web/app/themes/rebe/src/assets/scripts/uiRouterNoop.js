'use strict';
angular.module('uiRouterNoop', [])
  .service('$state', function() { return {} })
  .service('$urlRouter', function() { return {} });
