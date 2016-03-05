/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages

        // Make footer stick to the bottom of the page
        // using this solution http://jsfiddle.net/ed4xe1z9/
        function makeFooterSticky() {
          $('main').css('padding-bottom', $('footer').height());
          $('footer').css('margin-top', - $('footer').height());
        }

        // $('.js-lightbox').height($('main').height() + 100);
        // $('html, body').animate({ scrollTop: 0 }, 200);

        // all mess here is just a warkaround to fix the lightbox for the berlin milestone
        // Lightbox height is temporary set in:
        // - ng/stories/controllers/story.controller.js
        // - ng/events/controllers/event.controller.js
        function setLightboxHeight() {
          $('.js-lightbox').height($('main').height() + 100);
          $('.js-lightbox-nav-wrapper').height($('main').height() + 100);
        }

        // 'Donate' lighbox toggle
        $('.js-lightbox-open--donate').on('click', function (e) {
          e.preventDefault();
          $('.js-lightbox--donate').show();
        });

        $('.js-lightbox-close').on('click', function (e) {
          e.preventDefault();
          $('.js-lightbox--donate').hide();
        });

        // 'Book a workshop' lighbox toggle
        $('.js-lightbox-open--book-a-workshop').on('click', function (c) {
          c.preventDefault();
          $('.js-lightbox--book-a-workshop').show();
        });

        $('.js-lightbox-close').on('click', function (c) {
          c.preventDefault();
          $('.js-lightbox--book-a-workshop').hide();
        });

        if ( $(window).width() >= 550) {
          // Script for large screens

          makeFooterSticky();
          setLightboxHeight();

          $(window).resize(function () {
            makeFooterSticky();
            setLightboxHeight();
          });

        }
        else {
          // Script to run on small screens
          //
        }

        // Toggle head navigation menu on mobile/tablet screen
        $('.js-toggle-nav-menu').on('click', function(e) {
          e.preventDefault();
          $('.c-site-nav__list--head').toggle();
        });

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

        // Fit homepage content to viewport height
        function setHomepageHeight () {
          var elt = $('.js-main-block');
          var windowH = $(window).height();
          var footerH = $('footer').height();
          var headerH = $('header').height();
          var h = windowH - footerH;
          elt.height(h);
        }

        function setHomepageContentMargin () {
          var windowH = $(window).height();
          var footerH = $('footer').height();
          var contentH = $('.js-content-block').height();
          var mt = (windowH - footerH)/1.65 - contentH/2;
          $('.js-content-block').css('margin-top', mt);
        }

        setHomepageHeight();
        setHomepageContentMargin();

        $(window).resize( function() {
          setHomepageHeight();
          setHomepageContentMargin();
        });
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    'workshops': {
      init: function() {
        // JavaScript to be fired on the Workshops page
      }
    },
    // 404 page
    'error404': {
      init: function() {
        // JavaScript to be fired on the 404 page
        function fullHeight404Page () {
          var elt = $('.js-main-block');
          var windowH = $(window).height();
          elt.height(windowH);
        }

        fullHeight404Page();

        $(window).resize(fullHeight404Page);
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
