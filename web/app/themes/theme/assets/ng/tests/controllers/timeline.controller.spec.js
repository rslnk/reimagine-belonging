describe('Timeline Main Controller', function () {
  var timelineCtrl, scope, location, EventsService, httpBackend;

  beforeEach(module('events.timeline.controller'));

  beforeEach(inject(function ($controller, $rootScope, $location, $httpBackend) {
    scope = $rootScope.$new();
    httpBackend = $httpBackend;
    location = $location;
    timelineCtrl = $controller('TimelineController', {
      $scope: scope,
      $stateParams: { timeline: 'germany' }
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

  describe('topics filter', function () {

    beforeEach(function () {
      httpBackend
        .whenGET('/api/?action=list-all-events')
        .respond(eventsListMock);
      httpBackend.flush();
    });

    it('should have a topic toggle function defined', function () {
      expect(scope.toggleTopicInFilter).toBeDefined();
    });

    it('should add topic to the filter object', function () {
      var topic = 'test-topic';
      scope.toggleTopicInFilter(topic);
      expect(scope.filter.topics.indexOf(topic)).toBeGreaterThan(-1);
    });

    it('should remove topic from the filter', function () {
      var topic = 'test-topic';
      scope.toggleTopicInFilter(topic);
      expect(scope.filter.topics.indexOf(topic)).toBeGreaterThan(-1);
      scope.toggleTopicInFilter(topic);
      expect(scope.filter.topics.indexOf(topic)).toBe(-1);
    });

    it('should push topic to query string parameter', function () {
      var topic = 'test-query-param-topic';
      scope.toggleTopicInFilter(topic);
      scope.$digest();
      var searchObject = location.search();
      expect( searchObject.topics.split(',').indexOf(topic) ).toBeGreaterThan(-1);
    });

  });


});
