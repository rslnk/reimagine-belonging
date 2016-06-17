angular.module('workshops.filter', [])
  .filter('showWorkshops', function () {
    return function (workshops, filter) {
      var result = [];

      function filterIsSet () {
        return typeof filter !== angular.isUndefined && (typeof filter.topics !== angular.isUndefined || typeof filter.searchText !== angular.isUndefined);
      }

      function topicsFilterIsSet () {
        return typeof filter.topics !== angular.isUndefined && filter.topics.length > 0 && filter.topics instanceof Array;
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
        result = [];

        workshops.forEach(function (workshop) {
          if (withinTopicsFilter(workshop.topics)) {
            result.push(workshop);
          }
        });

        return result;
      }

      function showAll () {
        result = workshops;
      }

      function filterWorkshops () {
        if (filterIsSet() && topicsFilterIsSet()){
          filterByTopics();
        } else {
          showAll();
        }
        return result;
      }

      return filterWorkshops();
    };
  });
