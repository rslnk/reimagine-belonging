angular.module('events.events.filter', [])
  .filter('showEvents', function () {
    return function (events, filter) {
      var result = [];

      function filterIsSet () {
        return typeof filter !== 'undefined' && (typeof filter.topics !== 'undefined' || typeof filter.searchText !== 'undefined');
      }

      function topicsFilterIsSet () {
        return typeof filter.topics !== 'undefined' && filter.topics.length > 0 && filter.topics instanceof Array;
      }

      function withinTopicsFilter (topics) {
        var ts = topics.map(function (topic) {
          return topic.term_slug;
        });

        for (var i = 0, l = ts.length; i < l; i++){
          if (filter.topics.indexOf(ts[i]) > -1) {
            return true;
          }
        }

        return false;
      }

      function filterByTopics () {
        for (var i = 0, l = events.length; i < l; i++) {
          if (withinTopicsFilter(events[i].topics)) {
            result.push(events[i]);
          }
        }
      }

      function filterEvents () {
        if (filterIsSet() && topicsFilterIsSet()){
          filterByTopics();
        } else {
          result = events;
        }
        return result;
      }

      return filterEvents();
    };
  });
