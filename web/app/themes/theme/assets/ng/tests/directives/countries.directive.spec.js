describe('Countries Block Directive', function () {
  var element, scope, controller, compile, defaultData;
  var validTemplate = '<countries-switcher></countries-switcher>';

  function createDirective (params) {
    var elm;
    var data = params || defaultData;
    var template = '<countries-switcher '+
                    'countries="countries"' +
                    'timeline="timeline"' +
                    '></countries-switcher>';
    elm = compile(template || validTemplate)(scope);
    scope.$digest();
    return elm;
  }

  beforeEach(function () {
    module('events.countries.directive');

    defaultData = {};

    inject(function ($rootScope, $compile) {
      scope = $rootScope.$new();
      compile = $compile;
    });
  })
  
  beforeEach(function () {
    scope.countries = [
      { name: 'Germany', slug: 'germany' },
      { name: 'United States', slug: 'united-states' }
    ];
    scope.timeline = { name: 'United States', slug: 'united-states' };
    element = createDirective();
    controller = element.controller('countriesSwitcher');
  });


  describe('when created', function (){
    it('should have all countries except the active one in list', function () {
      var list = element.find('li');
      for (var i = 0, l = scope.countries.length; i < l; i++) {
        if (scope.countries[i].slug !== scope.timeline.slug){
          expect(angular.element(list[i]).text()).toContain(scope.countries[i].name);
        }
      }
    });

    it('should have active country set in h2 element', function () {
      expect(element.find('h2').text()).toContain('United States');
    });

    it('should have open attribute set to false', function () {
      expect( controller.open ).toBeFalsy();
    });
  });

  describe('when in use', function () {
    it('should change countries list to active state', function () {
      controller.toggle();
      expect(controller.open).toBeTruthy();
    });
  });
});
