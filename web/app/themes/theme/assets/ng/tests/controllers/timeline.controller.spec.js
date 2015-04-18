describe('Timeline Controller', function () {
  var timelineCtrl, scope, EventsService, httpBackend;

  beforeEach(module('events.timeline.controller'));

  beforeEach(inject(function ($controller, $rootScope, $httpBackend) {
    scope = $rootScope.$new();
    httpBackend = $httpBackend;
    timelineCtrl = $controller('TimelineController', {
      $scope: scope
    });
  }));

  it ('should exist', function () {
    expect(!!timelineCtrl).toBe(true);
  });

  describe('when created', function () {

    it ('should have empty events array', function () {
      expect(scope.events instanceof Array).toBe(true);
      expect(scope.events).toEqual([]);
    });

    it ('should have filter with empty topic and searchText', function () {
      expect(scope.filter instanceof Object).toBe(true);
      expect(scope.filter).toEqual({ topics: [], searchText: ''});
    });

    it ('should have empty config object', function () {
      expect(scope.config).toEqual({});
    });

    it ('should load events', function () {
      httpBackend
        .expectGET('/api/?action=list-all-events')
        .respond(eventsListMock);
      httpBackend.flush();
      expect(scope.events instanceof Array).toBe(true);
      expect(scope.events.length).toBeGreaterThan(0);
    });

  });

  describe('when events are loaded', function () {

    beforeEach(function () {
      httpBackend
        .whenGET('/api/?action=list-all-events')
        .respond(eventsListMock);
      httpBackend.flush();
    });

  });

});
