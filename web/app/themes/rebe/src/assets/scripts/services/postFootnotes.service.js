/*eslint angular/di: [2,"array"]*/
angular.module('postFootnotes.service', [])
  .factory('PostFootnotesService', ['$http', 'lodash', function ($http, lodash) {

    var service = {
      getSourceContributers: getSourceContributers,
      getResourceContributers: getResourceContributers,
    };
    return service;

    /////////

    function combineNames (list) {
      // Combine names for Event post sources and resources contributors
      // separated by coma.
      var arr = [];
      var i;
      var l = list.length;
      for (i = 0; i < l; i++) {
        arr.push(list[i].first_name + ' ' + list[i].last_name);
      }
      return arr.join(', ');
    };

    function getSourceContributers (sources) {
      // Get contributers for Event sources items
      if (sources) {
        sources.map(function (item) {
          if (item.author) {
            item.authors = combineNames(item.author);
          }

          if (item.editor) {
            item.editors = combineNames(item.editor);
          }

          if (item.translator) {
            item.translators = combineNames(item.translator);
          }
        });
      }

      return sources;
    };

    function getResourceContributers (resources) {
      // Get contributors for Event resources items
      if (resources) {
        resources.map(function (item) {
          if (item.author) {
            item.authors = combineNames(item.author);
          }

          if (item.editor) {
            item.editors = combineNames(item.editor);
          }

          if (item.translator) {
            item.translators = combineNames(item.translator);
          }
        });
      }
      return resources;
    };

}]);
