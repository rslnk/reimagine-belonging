module.exports = {
  'main page' : function (browser) {
    browser
      .url('http://reimaginebelonging.dev')
      .assert.containsText('h1', 'Latest Posts')
      .end();
  },
  '404 page': function (browser) {
    browser
      .url('http://reimaginebelonging.dev/404')
      .end();
  }
};
