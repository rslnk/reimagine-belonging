angular.module('stories.filter', [])
  .filter('showStories', function () {
    return function (stories, filter) {
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

        stories.forEach(function (story) {
          if (withinTopicsFilter(story.topics)) {
            result.push(story);
          }
        });

        return result;
      }

      function showAll () {
        result = stories;
      }

      function filterStories () {
        if (filterIsSet() && topicsFilterIsSet()){
          filterByTopics();
        } else {
          showAll();
        }
        return result;
      }

      return filterStories();
    };
  });
