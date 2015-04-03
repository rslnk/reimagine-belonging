<?php
/*
  Plugin Name:  Base Setup
  Description:  Automatically sets site specific defaults: * Sets upload path to /media; * Sets upload path URL to example.com/media; * Disables year/month folder structure for uploads; * Sets permalink structure to post name; * Creates data api URL; * Sets save/load path to ACF PRO JSON custom fileds;
  Version:      1.0.0
  Author:       Ruslan Komjakov
  Author URI:   https://github.com/rslnk
*/

if (!is_blog_installed()) { return; }

/*
  WordPress Setup

  Set uploads path to /media;
  Set uploads URL path to example.com/media;
  Set permalink structure to post name

  Based on Roots.io wp-setup.php file
  https://gist.github.com/swalkinshaw/6400708
 */

if ('http://' . $_SERVER['SERVER_NAME'] . '/wp' == get_option('siteurl')) {
  update_option('upload_path', $_SERVER['DOCUMENT_ROOT'] . '/media');
  update_option('upload_url_path', 'http://' . $_SERVER['SERVER_NAME'] . '/media');
  update_option('uploads_use_yearmonth_folders', false);
  update_option('permalink_structure', '/%postname%/');
}

/*
  API data endpoint

  Creates example.com/api URL and includes custom template

  Based on Creating an API Endpoint in WordPress by Ken Snyder
  http://kendsnyder.com/creating-an-api-endpoint-in-wordpress/
 */

add_action( 'parse_request', 'create_api_endpoint', 0 );

function create_api_endpoint() {
  global $wp;
  // Create URL endpoint
  if ( $wp->request == 'api' ) {
    // Include custom template
    require_once( __DIR__ . '/api-data.php' );
    die;
  }
}

/*
  ACF PRO Setup

  Set custom save/load path to JSON custom fields
  http://www.advancedcustomfields.com/resources/local-json/
 */

add_filter('acf/settings/save_json', 'custom_acf_json_save_point');
add_filter('acf/settings/load_json', 'custom_acf_json_load_point');

function custom_acf_json_save_point( $path ) {
  // update path
  $path = __DIR__ . '/custom-fields';
  // return
  return $path;
  /* echo $path; */
}
function custom_acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);
  // append path
  $paths[] = __DIR__ . '/custom-fields';
  // return
  return $paths;
}