angular.module('stories.list.filter', [])
  .filter('showStories', function () {
    return function (stories, filter) {
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
        stories.map(function (story) {
          if (!story.topics || !withinTopicsFilter(story.topics)) {
            story.hide = true;
            console.log('hide');
          }
          else {
            story.hide = false;
            console.log('show');
          }
        });
      }

      function showAll () {
        stories.map(function (story) {
          story.hide = false;
        });
      }

      function filterStories () {
        if (filterIsSet() && topicsFilterIsSet()){
          filterByTopics();
        } else {
          showAll();
        }
        return stories;
      }

      return filterStories();
    };
  });
