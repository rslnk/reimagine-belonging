<?php

namespace Roots\Sage\Config;

use Roots\Sage\ConditionalTagCheck;

/**
 * Enable theme features
 */
add_theme_support('soil-clean-up');                 // Enable clean up from Soil
add_theme_support('soil-nav-walker');               // Enable cleaner nav walker from Soil
add_theme_support('soil-relative-urls');            // Enable relative URLs from Soil
add_theme_support('soil-jquery-cdn');               // Enable to load jQuery from the Google CDN
add_theme_support('soil-js-to-footer');             // Move all JS to the footer
add_theme_support('soil-disable-trackbacks');       // Disable trackbacks
add_theme_support('soil-disable-asset-versioning'); // Disable asset versioning
add_theme_support('soil-google-analytics', get_field('google_analytics_id', 'option')); // Enable H5BP's Google Analytics snippet

/**
 * Configuration values
 */

if (!defined('WP_ENV')) {
  // Fallback if WP_ENV isn't defined in your WordPress config
  // Used in lib/assets.php to check for 'development' or 'production'
  define('WP_ENV', 'production');
}

if (!defined('DIST_DIR')) {
  // Path to the build directory for front-end assets
  define('DIST_DIR', '/dist/');
}

/**
 * Determine which pages should NOT display the sidebar
 */
function display_sidebar() {
  static $display;

  isset($display) || $display = !in_array(true, [
    // The sidebar will NOT be displayed if ANY of the following return true.
    // @link https://codex.wordpress.org/Conditional_Tags
    is_404(),
    is_front_page(),
    //is_page_template('template-custom.php'),
  ]);
  return apply_filters('sage/display_sidebar', $display);
}
/**
 * $content_width is a global variable used by WordPress for max image upload sizes
 * and media embeds (in pixels).
 *
 * Example: If the content area is 640px wide, set $content_width = 620; so images and videos will not overflow.
 * Default: 1140px is the default Bootstrap container width.
 */
if (!isset($content_width)) {
  $content_width = 1140;
}
