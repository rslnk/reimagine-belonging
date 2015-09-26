<?php

/*

  WordPress as a REST API
  -----------------------

  Based on Pete Nelson's https://gist.github.com/petenelson/4724984
  See also: http://www.billerickson.net/code/improve-performance-of-wp_query

  API calls
  =========

  1) example.com/api/?action=list-all-events
  2) List all 'stories' post type (to do!)

*/

require_once('data-filter.class.php');
require_once('api-data.class.php');

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : false;
$path = isset($_REQUEST['path']) ? $_REQUEST['path'] : false;

$output = null;
$api = new API_Data();

switch ($action) {

  case 'site-configuration':
    $output = $api->site_configuration();
    break;

  case 'list-all-events':
    $output = $api->list_all_events();
    break;

  case 'list-all-stories':
    $output = $api->list_all_stories();
    break;

  case 'event-data':
    $output = $api->event_data($id, $path);
    break;

  case 'story-data':
    $output = $api->story_data($id, $path);
    break;

  default:
    $output = array('error' => 'invalid action');
    break;
}

if ($output) {
  // callback support for JSONP
  if (isset($_REQUEST["callback"])) {
    header("Content-Type: application/javascript");
    echo $_REQUEST['callback'] . '(' . json_encode($output) . ')';
  }
  else {
    header("Content-Type: application/json");
    echo json_encode($output);
  }
}

die();
