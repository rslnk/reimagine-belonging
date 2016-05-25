<?php namespace App;

use ReBe\API\SiteDataConstructor;
use ReBe\API\PostDataConstructor;

/**
 * REST API endpoint and data calls
 *
 * Based on Creating an API Endpoint in WordPress by Ken Snyder
 * @link http://kendsnyder.com/creating-an-api-endpoint-in-wordpress
 * API data calls are based on Pete Nelson's solution:
 * @link https://gist.github.com/petenelson/4724984
 * @link http://www.billerickson.net/code/improve-performance-of-wp_query
 *
 * The following data endpoints are available:
 *
 * @link reimaginebelonging.dev/api/?action=site-configuration
 * @link reimaginebelonging.dev/api/?action=list-all-events
 * @link reimaginebelonging.dev/api/?action=list-all-stories
 * @link reimaginebelonging.dev/api/?action=list-all-workshops
 * @link reimaginebelonging.dev/api/?action=list-all-pages
 * @link reimaginebelonging.dev/api/?action=event-data&id=820
 * @link reimaginebelonging.dev/api/?action=story-data&id=1474
 * @link reimaginebelonging.dev/api/?action=workshop-data&id=1851
 * @link reimaginebelonging.dev/api/?action=page-data&id=1699
 */
function register_api_endpoints()
{
    global $wp;

    // Create URL endpoint
    if ($wp->request == 'api') {

        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
        $output = null;

        switch ($action) {

            case 'site-configuration':
                $object = new SiteDataConstructor('all');
                $output = $object->get_site_data();
                break;

            case 'list-all-events':
                $object = new PostDataConstructor('event', 'teaser', 'list');
                $output = $object->get_post_data();
                break;

            case 'list-all-stories':
                $object = new PostDataConstructor('story', 'teaser', 'list');
                $output = $object->get_post_data();
                break;

            case 'list-all-workshops':
                $object = new PostDataConstructor('workshop', 'teaser', 'list');
                $output = $object->get_post_data();
                break;

            case 'list-all-pages':
                $object = new PostDataConstructor('page', 'teaser', 'list');
                $output = $object->get_post_data();
                break;

            case 'event-data':
                $object = new PostDataConstructor('event', 'full', 'single');
                $output = $object->get_post_data();
                break;

            case 'story-data':
                $object = new PostDataConstructor('story', 'full', 'single');
                $output = $object->get_post_data();
                break;

            case 'workshop-data':
                $object = new PostDataConstructor('workshop', 'full', 'single');
                $output = $object->get_post_data();
                break;

            case 'page-data':
                $object = new PostDataConstructor('page', 'full', 'single');
                $output = $object->get_post_data();
                break;

            default:
                $output = ['error' => 'invalid action'];
                break;
        }

        if ($output) {
            // callback support for JSONP
            if (isset($_REQUEST["callback"])) {
                header("Content-Type: application/javascript");
                echo $_REQUEST['callback'] . '(' . json_encode($output) . ')';
            } else {
                header("Content-Type: application/json");
                echo json_encode($output);
            }
        }
        die;
        }
}
