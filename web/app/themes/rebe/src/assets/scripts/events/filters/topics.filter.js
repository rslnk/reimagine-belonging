angular.module('topics.filter', [])
  .filter('showTopics', function () {
    return function (events) {
      var topics = [];

      function isInArray (topic) {
        for (var i = 0, l = topics.length; i < l; i++) {
          if (topics[i].term_slug === topic.term_slug) {
            return true;
          }
        }
        return false;
      }

      function fetchTopics () {
        angular.forEach(events, function (timelineEvent) {
          angular.forEach(timelineEvent.topics, function (topic) {
            if (!isInArray(topic)) {
              topics.push(topic);
            }
          });
        });

        return topics;
      }

      return fetchTopics();
    };
});
