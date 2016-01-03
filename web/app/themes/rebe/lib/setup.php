<?php

namespace ReBe\Setup;

use ReBe\Assets;

/**
 * Theme setup
 */

// Enable features from Soil when plugin is activated
// https://roots.io/plugins/soil/
add_theme_support('soil-clean-up');                 // Enable clean up from Soil
add_theme_support('soil-nav-walker');               // Enable cleaner nav walker from Soil
add_theme_support('soil-relative-urls');            // Enable relative URLs from Soil
add_theme_support('soil-jquery-cdn');               // Enable to load jQuery from the Google CDN
add_theme_support('soil-js-to-footer');             // Move all JS to the footer
add_theme_support('soil-disable-trackbacks');       // Disable trackbacks
add_theme_support('soil-disable-asset-versioning'); // Disable asset versioning
$gai = get_field('google_analytics_id', 'option');  // Get Google Analytics ID from Site settings in WordPress admin
add_theme_support('soil-google-analytics', $gai);   // Enable H5BP's Google Analytics snippet

function setup() {
  // Enable plugins to manage the document title
  // http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
  add_theme_support('title-tag');

  // Register wp_nav_menu() menus
  // http://codex.wordpress.org/Function_Reference/register_nav_menus
  register_nav_menus([
    'primary_navigation'    => __('Primary Navigation', 'rebe'),
    'secondary_navigation'  => __('Secondary Navigation', 'rebe')
  ]);

  // Enable post thumbnails
  // http://codex.wordpress.org/Post_Thumbnails
  // http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
  // http://codex.wordpress.org/Function_Reference/add_image_size
  add_theme_support('post-thumbnails');

  update_option('thumbnail_size_w', 250);   // 'thumbnail' image preview size
  update_option('thumbnail_size_h', 250);
  update_option('medium_size_w', 800);      // 'medium' image preview size
  update_option('medium_size_h', 9999);
  update_option('large_size_w', 1200);      // 'large' image preview size
  update_option('large_size_h', 9999);

  // Enable post formats
  // http://codex.wordpress.org/Post_Formats
  add_theme_support('post-formats', ['video', 'audio']);

  // Enable HTML5 markup support
  // http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
  add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);
}
add_action('after_setup_theme', __NAMESPACE__ . '\\setup');

/**
 * Theme assets
 */
function assets() {
  wp_enqueue_style('rebe/css', Assets\asset_path('styles/main.css'), false, null);
  wp_enqueue_script('rebe/js', Assets\asset_path('scripts/main.js'), ['jquery'], null, true);

  // Angular apps (this must be contatinated into main.js required on corresponding templates!)
  wp_enqueue_script('events/js', Assets\asset_path('scripts/events.js'), [], null, true);
  wp_enqueue_script('stories/js', Assets\asset_path('scripts/stories.js'), [], null, true);

  // OWL Carousel (used for Events timeline)
  wp_enqueue_style('owl.carousel.main', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css', false, null);
  wp_enqueue_style('owl.carousel.theme', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css', false, null);
  wp_enqueue_style('owl.carousel.transitions', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.min.css', false, null);
  wp_enqueue_script('owl_carousel', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', [], null, true);

  // Fonts and icons
  wp_enqueue_style('fonts/css', 'http://fast.fonts.net/cssapi/dae2ada1-fb62-4216-ab20-8072b137a586.css', false, null);
  wp_enqueue_style('google/fonts/css', 'http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700', false, null);
  wp_enqueue_style('icons/svg/css', Assets\asset_path('styles/icons.svg.css'), false, null);
}
add_action('wp_enqueue_scripts', __NAMESPACE__ . '\\assets', 100);
