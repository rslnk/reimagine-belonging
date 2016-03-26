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

        // Toggle modal menu
        $(function () {
            $('.js-modal-menu-open, .js-modal-menu-close').click(function () {
                $($(this).attr('data-target')).toggle();
            });
        });

        // Toggle footer directory section
        $(function () {
            $('.js-directory-section-toggle').click(function () {
                $($(this).attr('data-target')).toggle();
                $($(this)).toggleClass('is-expanded');
            });
        });

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

        $('.o-overlay').on('scroll touchmove mousewheel', function (event) {
            event.preventDefault();
        });

        if ( $(window).width() >= 550) {
          // Script for large screens
        }
        else {
          // Script to run on small screens
        }

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page

        // Set homepage container height to viewport height
        function setHomepageContainerHeight() {
          var elt = $('.js-home');
          var windowHeight = $(window).height();
          var homepageContainerHeight = windowHeight;
          elt.height(homepageContainerHeight);
        }

        // Set homepage content top margin
        function setHomepageContentMargin() {
          var windowHeight = $(window).height();
          //var footerHeihgt = $('footer').height();
          var contentHeight = $('.js-home-content').height();
          var contentMarginTop = (windowHeight - contentHeight)/1.2;
          $('.js-home-content').css('margin-top', contentMarginTop);
        }

        // Apply homepage container hight and content top margin
        setHomepageContainerHeight();
        setHomepageContentMargin();

        // Update homepage container hight and content top margin on window resize
        $(window).resize( function() {
          setHomepageContainerHeight();
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
