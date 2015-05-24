describe("Events Filter", function () {
  var eventsFilter;

  beforeEach(module('events.events.filter'));
  beforeEach(inject(function ($filter) {
    eventsFilter = $filter('showEvents');
  }));

  it('should exist', function () {
    expect(!!eventsFilter).toBe(true);
  });

  // describe('when evaluating expression', function () {
  //
  //   it('should return an array of events', function () {
  //     expect(eventsFilter(eventsListMock) instanceof Array).toBe(true);
  //   });
  //
  //   it('should filter events by one topic', function () {
  //     var filter = { topics: ['topic-10'] };
  //     expect(eventsFilter(eventsListMock, filter).length).toBeLessThan(eventsListMock.length);
  //   });
  //
  //   it('should filter events by multiple topics', function () {
  //     var filter = { topics: ['topic-10', 'topic-1'] };
  //     var events = eventsFilter(eventsListMock, filter);
  //     for (var i = 0, l = events.length; i < l; i++) {
  //       var ts = events[i].topics.map(function (topic) { return topic.term_slug; });
  //       var withinRange = false;
  //
  //       for (var j = 0, m = filter.topics.length; j < m; j++) {
  //         if (ts.indexOf(filter.topics[j]) > -1) {
  //           withinRange = true;
  //           break;
  //         }
  //       }
  //
  //       expect( withinRange ).toBe(true);
  //     }
  //   });
  //
  //   it('should return all events if no topics are selected', function () {
  //     var filter = { topics: [], searchText: '' };
  //     var events = eventsFilter(eventsListMock, filter);
  //     expect(events.length).toBe(eventsListMock.length);
  //   });
  // });

});
