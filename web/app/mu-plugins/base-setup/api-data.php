<?php
/*
* WordPress as a REST API
*
* example.com/api/?action=list-all-events
*
* Based on Pete Nelson's https://gist.github.com/petenelson/4724984
* See also: http://www.billerickson.net/code/improve-performance-of-wp_query
*
* API calls:
*
* 1) List all 'events' post type
* To do: 2) List all 'stories' post type
*
*/

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

$output = null;
$api = new API_Data();

switch ($action) {

  case 'list-all-events':
    $output = $api->list_all_events();
    break;

  case 'list-all-stories':
    $output = $api->list_all_events();
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


class API_Data {

  function list_all_events() {

    $query = new WP_Query(
      array(
        'post_type' => 'events',
        'no_found_rows' => true, // counts posts, remove if pagination required
        //'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
        //'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
      )
    );

    $output = array();

    while ($query->have_posts()) {
      $p= $query->next_post();

      $output[] = array(
        'id' => $p->ID,
        //'title' => $p->post_title,
        'post_date_gmt' => $p->post_date_gmt,
        'permalink' => get_permalink( $p->ID ),

        'title' => $p->event_title,
        'subtitle' => $p->event_subtitle,

        'start_date' => $p->event_dates, // ->start_date,
        'end_date' => $p->event_dates, // ->end_date,
        'display_end_date' => $p->event_dates, // ->end_date_display,

        'timelines' => $p->event_taxonomies, // ->timelines,
        'eras' => $p->event_taxonomies, // ->eras,
        'types' => $p->event_taxonomies, // ->types,
        'groups' => $p->event_taxonomies, // ->groups,
        'topics' => $p->event_taxonomies, // t->opics,
        'tags' => $p->event_taxonomies // ->tags,

        //'preview_image_url' => $p->preview_image
      );

    }

    return $output;

  }

}