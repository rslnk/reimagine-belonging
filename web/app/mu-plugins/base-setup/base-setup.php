<?php
/*
  Plugin Name:  Base Setup
  Description:  Automatically sets site specific defaults.
  Version:      1.0.0
  Author:       Ruslan Komjakov
  Author URI:   https://github.com/rslnk

  * Sets upload path to /media;
  * Sets upload path URL to example.com/media
  * Disables year/month folder structure for uploads
  * Sets permalink structure to post name
  * Creates data api endpoint URL
  * Sets save/load path to ACF PRO JSON custom fileds

*/


if (!is_blog_installed()) { return; }

/*

  WordPress Setup
  ---------------

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
  -----------------

  Creates example.com/api URL and includes custom template

  Based on Creating an API Endpoint in WordPress by Ken Snyder
  http://kendsnyder.com/creating-an-api-endpoint-in-wordpress

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

  Events redirects
  ----------------

  Catches all stories requests.
  Redirecs to angular app if user-agent is not a bot or a crowler
  overwice responds with a content.

 */

add_action('parse_request', 'create_stories_proxy', 1);

function create_stories_proxy () {
  global $wp;
  if (preg_match("/stories/i", $wp->request)) {
    require_once( __DIR__ . '/is-bot.php');
    if (!is_bot()){
      $url = $_SERVER["REQUEST_URI"];
      $parts = explode('/', rtrim($url, '/'));
      if (count($parts) > 2) {
        setcookie("stories", $url, time()+3600, "/");
        header('Location: /stories/');
        exit;
      }
    }
  }
}


/*

  History redirects
  ----------------

  Catches all history pages requests.
  Redirecs to angular app if user-agent is not a bot or a crowler
  overwice responds with a content.

 */

add_action('parse_request', 'create_history_proxy', 2);

function create_history_proxy () {
  global $wp;
  if (preg_match("/history/i", $wp->request)) {
    require_once( __DIR__ . '/is-bot.php');

    $url = $_SERVER["REQUEST_URI"];
    $parts = explode('/', rtrim($url, '/'));

    if (is_bot()){
      if (count($parts) > 2) {
        setcookie("history", $url, time()+3600, "/");
        header('Location: /history/');
        exit;
      }
    } else {
      $countries = array('united-states','germany');

      if (count($parts) > 2 && in_array($parts[2], $countries)) {
        header('Location: /history/events/'.$parts[3]);
        exit;
      }
    }
  }
}




/*

  ACF PRO Setup
  -------------

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
