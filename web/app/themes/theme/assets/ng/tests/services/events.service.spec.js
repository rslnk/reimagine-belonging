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
    it ('should have fetch method', function () {
      expect(eventsService.get).toBeDefined();
    });

    it ('should request API server for a list of all events', function () {
      var data;

      httpBackend
        .expectGET('/api/?action=list-all-events')
        .respond([{ foo: 'bar' }]);

      eventsService
        .get()
        .then(function (response) {
          data = response;
        });

      httpBackend.flush();

      expect( data instanceof Array ).toEqual(true);
      expect( data[0]['foo'] ).toEqual('bar');
    });
  });
});
