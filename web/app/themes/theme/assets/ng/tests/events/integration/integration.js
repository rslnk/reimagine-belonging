describe("Integration of Events Application", function () {
  var app, scope, state, provide, httpBackend;

  beforeEach(module('events.constants', function ($provide) {
    $provide.constant('templatesPath', '');
  }));
  beforeEach(module('eventsApp'));

  beforeEach(module('events/templates/timeline.html'));
  beforeEach(module('events/templates/timeline.event.html'));

  beforeEach(inject(function($compile, $rootScope, $httpBackend) {
    var html = '<div ng-app="eventsApp"><div ui-view></div></div>';
    scope = $rootScope.$new();
    app = $compile(html)(scope);
    state = scope.$state;
    httpBackend = $httpBackend;
    stateParams = scope.$stateParams;
    $rootScope.$digest();
  }));

  // it ('should exist', function () {
  //   expect(!!app).toBe(true);
  // });

//   describe('Timeline State', function () {
//     it ('should have current state name "timeline"', function () {
//       expect(state.current.name).toBe('timeline');
//     });
//   });

//   describe('Event State', function () {
//     it ('should have current state name "timeline.event"', function () {
//       state.go('timeline.event', { timeline: 'any-timeline', event: 'any-event'});
//       scope.$digest();
//       expect(state.current.name).toBe('timeline.event');
//     });
//   });

});
