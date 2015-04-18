describe ('Topics Filter', function () {
  var topicsFilter;

  beforeEach(module('events.topics.filter'));
  beforeEach(inject(function ($filter) {
    topicsFilter = $filter('showTopics');
  }));

  it('should exist', function () {
    expect(!!topicsFilter).toBe(true);
  });

  describe('when evaluating an expression', function () {

    it('should return array of topics', function () {
      expect(topicsFilter(eventsListMock) instanceof Array).toBe(true);
    });

    it('should have unique items in array', function () {
      var topics = topicsFilter(eventsListMock);
      var counts = {};

      for (var i = 0, l = topics.length; i < l; i++) {
        var slug = topics[i].term_slug;
        counts[slug] = counts[slug] ? counts[slug]+1 : 1;
      }
      for (count in counts) {
        expect( counts[count] ).toBe(1);
      }
    });

    it('each topic should have name, slug and color', function () {
      var topics = topicsFilter(eventsListMock);
      for (var i = 0, l = topics.length; i < l; i++){
        var item = topics[i];
        expect(item.term_name).toBeDefined();
        expect(item.term_slug).toBeDefined();
        expect(item.term_color).toBeDefined();
      }
    });

  });

});
