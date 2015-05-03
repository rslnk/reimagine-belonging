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
        events.map(function (event) {
          if (!withinTopicsFilter(event.topics)) {
            event.hide = true;
          }
          else {
            event.hide = false;
          }
        });
      }

      function showAll () {
        events.map(function (event) {
          event.hide = false;
        });
      }

      function filterEvents () {
        if (filterIsSet() && topicsFilterIsSet()){
          console.log( 'filter' );
          filterByTopics();
        } else {
          console.log('show all');
          showAll();
        }
        return events;
      }

      return filterEvents();
    };
  });
