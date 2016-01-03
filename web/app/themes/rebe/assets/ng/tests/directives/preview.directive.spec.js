describe('Preview Block Directive', function () {
  var element, scope, compile, defaultData;
  var validTemplate = '<event-preview></event-preview>';

  function createDirective (params) {
    var elm;
    var data = params || defaultData;
    var template = '<event-preview '+
                      'year="'+data.year+'"'+
                      'title="'+data.title+'"'+
                      'image="'+data.image+'"'+
                      'slug="'+data.slug+'"'+
                     '></event-preview>';
    elm = compile(template || validTemplate)(scope);
    scope.$digest();
    return elm;
  }

  beforeEach(function () {
    module('events.preview.directive');

    defaultData = {
      image: 'path/to/image',
      title: 'Darja meets Sergei',
      year: '2009',
      slug: 'event-slug-123'
    };

    inject(function ($rootScope, $compile) {
      scope = $rootScope.$new();
      compile = $compile;
    });
  });

  describe('when created', function () {
    beforeEach(function () { 
      element = createDirective(); 
    });

    it('should have set a year', function () {
      expect(element.find('span').text()).toContain(defaultData.year);
    });

    it('should have set a title', function () {
      expect(element.find('h4').text()).toContain(defaultData.title);
    });

    it('should have set a background', function () {
      expect(element.css('background-image')).toContain(defaultData.image);
    });

    it('should have a slug attr', function () {
      expect(element.attr('slug')).toBe(defaultData.slug);
    });
  });
});
