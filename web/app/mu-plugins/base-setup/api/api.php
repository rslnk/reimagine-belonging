<?php
/*

  # WordPress REST API

  Sets API data endpoint to reimaginebelonging.dev/api

  This project uses the following API calls in order to get data
  for Events and Stories apps built with Angular:

  1) reimaginebelonging.dev/api/?action=site-configuration
  2) reimaginebelonging.dev/api/?action=list-all-events
  3) reimaginebelonging.dev/api/?action=list-all-stories
  4) reimaginebelonging.dev/api/?action=event-data&id=820
  5) reimaginebelonging.dev/api/?action=story-data&id=1474

  Based on Creating an API Endpoint in WordPress by Ken Snyder
  http://kendsnyder.com/creating-an-api-endpoint-in-wordpress

  API data calls are based on Pete Nelson's solution:
  https://gist.github.com/petenelson/4724984

  See also: http://www.billerickson.net/code/improve-performance-of-wp_query

 */

use BaseSetup\API\Data;

add_action( 'parse_request', 'ReimagineBelongingAPI', 0 );

function ReimagineBelongingAPI() {
  global $wp;
  // Create URL endpoint
  if ( $wp->request == 'api' ) {

    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
    $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : false;
    $path = isset($_REQUEST['path']) ? $_REQUEST['path'] : false;
    $output = null;

    switch ($action) {

      case 'site-configuration':
        require_once('data/site-configuration.php');
        $output = Data\siteConfiguration();
        break;

      case 'list-all-events':
        require_once('data/filter.php');
        require_once('data/all-events.php');
        $output = Data\allEventsPostsPreviews();
        break;

      case 'list-all-stories':
        require_once('data/filter.php');
        require_once('data/all-stories.php');
        $output = Data\allStoriesPostsPreviews();
        break;

      case 'event-data':
        require_once('data/filter.php');
        require_once('data/single-event.php');
        $output = Data\eventSinglePost($id, $path);
        break;

      case 'story-data':
        require_once('data/filter.php');  
        require_once('data/single-story.php');
        $output = Data\storySinglePost($id, $path);
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
    die;
  }
}
