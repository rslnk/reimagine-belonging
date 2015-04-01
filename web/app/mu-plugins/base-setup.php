<?php
/*
  Plugin Name:  Base Setup
  Description:  Automatically sets site specific defaults: * Sets upload path to /media; * Sets upload path URL to example.com/media; * Disables year/month folder structure for uploads; * Sets permalink structure to post name; * Sets save/load path to ACF PRO JSON custom fileds;
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
  ACF PRO Setup

  Set custom save/load path to JSON custom fields
  http://www.advancedcustomfields.com/resources/local-json/
 */

add_filter('acf/settings/save_json', 'custom_acf_json_save_point');
add_filter('acf/settings/load_json', 'custom_acf_json_load_point');

function custom_acf_json_save_point( $path ) {
  // update path
  $path = WPMU_PLUGIN_DIR . '/acf-custom-fields';
  // return
  return $path;
}
function custom_acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);
  // append path
  //$paths[] = get_stylesheet_directory() . '../mu-plugins/acf-custom-fields';
  $paths[] = WPMU_PLUGIN_DIR .'/acf-custom-fields';
  // return
  return $paths;
}