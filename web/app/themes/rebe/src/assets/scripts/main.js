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

        $('.js-modal-menu').on('scroll touchmove mousewheel', function (event) {
            event.preventDefault();
        });

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'js_home': {
      init: function() {
        // JavaScript to be fired on the home page

        var BackgroundImage   = $('.js-background-image');

        // Set home background image height to window height
        function setBackgroundImageHeigh() {
            BackgroundImage.height($(window).height());
        }

        // Apply homepage container hight and content top margin
        setBackgroundImageHeigh();

        // Listen to screen orientation changes
        window.addEventListener("orientationchange", function() {
            setBackgroundImageHeigh();
        }, false);

        // Listen for screen resize changes
        window.addEventListener("resize", function() {
          setBackgroundImageHeigh();
        }, false);

      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // 404 page
    'js_404': {
      init: function() {
        // JavaScript to be fired on the 404 page

        // Set page container height to window height
        function setPageHeight() {
          var PageContainer = $('.js-404');
          var windowHeight = $(window).height();
          PageContainer.height(windowHeight);
        }

        setPageHeight();

        // Listen to screen orientation changes
        window.addEventListener("orientationchange", function() {
            setPageHeight();
        }, false);

        // Listen for screen resize changes
        window.addEventListener("resize", function() {
          setPageHeight();
        }, false);

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
