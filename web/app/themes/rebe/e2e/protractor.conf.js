'use strict';

exports.config = {

  capabilities: {
    'browserName': 'chrome'
  },

  specs: ['e2e/**/*.js'],

  jasmineNodeOpts: {
    showColors: true,
    defaultTimeoutInterval: 3000
  }

}
