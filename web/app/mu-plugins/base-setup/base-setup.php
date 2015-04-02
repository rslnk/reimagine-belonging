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
  JSON API endpoint


  https://make.wordpress.org/plugins/2012/06/07/rewrite-endpoints-api
  https://gist.github.com/joncave/2891111
 */

add_action( 'parse_request', function() {
    global $wp;
    echo $wp->query_vars;
    foreach ($wp->query_vars as $result) { echo $result->type; echo "<br>"; }
    if ( $wp->query_vars['pagename'] == 'api/events' ) {
        //require_once( __DIR__ . '/my/endpoint.php' );
      echo 'test';
      die;
    }
}, 0 );

/*
add_action( 'init', 'makeplugins_endpoints_add_endpoint' );
add_action( 'template_redirect', 'makeplugins_endpoints_template_redirect' );

register_deactivation_hook( __FILE__, 'makeplugins_endpoints_deactivate' );
register_activation_hook( __FILE__, 'makeplugins_endpoints_activate' );
*/

function makeplugins_endpoints_add_endpoint() {
  // register a "json" endpoint to be applied to posts and pages
  add_rewrite_endpoint( 'json', EP_PERMALINK | EP_PAGES );
}

function makeplugins_endpoints_template_redirect() {
  global $wp_query;
  // if this is not a request for json or it's not a singular object then bail
  if ( ! isset( $wp_query->query_vars['json'] ) || ! is_singular() )
  return;
  // output some JSON (normally you might include a template file here)
  // include custom template
  include dirname( __FILE__ ) . '/json-api.php';
  exit;
}

function makeplugins_endpoints_do_json() {
  header( 'Content-Type: application/json' );
  $post = get_queried_object();
  echo json_encode( $post );
}

function makeplugins_endpoints_activate() {
  // ensure our endpoint is added before flushing rewrite rules
  makeplugins_endpoints_add_endpoint();
  // flush rewrite rules - only do this on activation as anything more frequent is bad!
  flush_rewrite_rules();
}

function makeplugins_endpoints_deactivate() {
  // flush rules on deactivate as well so they're not left hanging around uselessly
  flush_rewrite_rules();
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
  $path = dirname( __FILE__ ) . '/custom-fields';
  // return
  return $path;
  echo $path;
}
function custom_acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);
  // append path
  $paths[] = dirname( __FILE__ ) . '/custom-fields';
  // return
  return $paths;
}