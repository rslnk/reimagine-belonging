'use strict';

describe('Event Service', function () {
  var eventsService, httpBackend;

  beforeEach(module('eventsApp'));
  beforeEach(module('uiRouterNoop'));
  beforeEach(inject(function(EventsService, $httpBackend) {
    eventsService = EventsService;
    httpBackend = $httpBackend;
  }));

  afterEach(function () {
    httpBackend.verifyNoOutstandingRequest();
    httpBackend.verifyNoOutstandingExpectation();
  });

  it ('should exist', function () {
    expect(!!eventsService).toBe(true);
  });

  describe ('the service api', function () {

    it ('should have get method', function () {
      expect(eventsService.get).toBeDefined();
    });

    it ('should request API server for events', function () {
      httpBackend
        .expectGET('/api/?action=list-all-events')
        .respond(eventsListMock);
      eventsService.get('united-states');
      httpBackend.flush();
    });

    it('should have content for specific country', function () {
      var data;

      httpBackend
        .expectGET('/api/?action=list-all-events')
        .respond(eventsListMock);

      eventsService.get('germany')
        .then(function (response) {
          data = response;
        });

      httpBackend.flush();
    });
  });
});
