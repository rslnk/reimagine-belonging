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
  function termsArray($terms) {
    $arr = array();
    foreach ( $terms as $term ) {
      $arr[] = array(
        'name' => $term->name,
        'slug' => $term->slug
      );
    }
    return $arr;
  }

  function list_all_events() {

    $query = new WP_Query(array(
      'post_type' => 'event',
      'no_found_rows' => true, // counts posts, remove if pagination required
      //'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
      //'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
    ));

    $output = array();

    while ($query->have_posts()) {
      $p = $query->next_post();
      $fields = get_fields($p->ID);
      $dates = $fields['event_dates'][0];
      $taxonomy = $fields['event_taxonomies'][0];

      $timelines = get_the_terms( $p->ID , 'event_timeline' );
      $eras = get_the_terms( $p->ID , 'event_era' );
      $types = get_the_terms( $p->ID , 'event_type' );
      $groups = get_the_terms( $p->ID , 'event_group' );
      $topics = get_the_terms( $p->ID , 'event_topic' );
      $tags = get_the_terms( $p->ID , 'event_tag' );

      // vars
      $output[] = array(
        'id'          => $p->ID,
        'permalink'   => get_permalink( $p->ID ),
        'subtitle'    => $p->event_subtitle,
        'start_date'  => $dates['start_date'],
        'end_date'    => $dates['end_date'],
        'display_end_date' => $dates['end_date'],
        'timelines'   => $this->termsArray($timelines),
        'eras'        => $this->termsArray($eras),
        'types'       => $this->termsArray($types),
        'groups'      => $this->termsArray($groups),
        'topics'      => $this->termsArray($topics),
        'tags'        => $this->termsArray($tags)
      );

    }

    return $output;

  }

}
