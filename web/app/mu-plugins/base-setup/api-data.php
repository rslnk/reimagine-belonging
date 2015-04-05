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

  function terms_array($terms) {
    $arr = array();
    if ( !empty( $terms ) ) {
      foreach ( $terms as $term ) {
        $arr[] = array(
          'name'  => $term->name,
          'slug'  => $term->slug
        );
      }
      return $arr;
    }
  }

  function list_all_events() {

    $query = new WP_Query(array(
      'post_type' => 'event',
      'no_found_rows' => true, // counts posts, remove if pagination required
      'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
      'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
    ));

    $output = array();

    while ($query->have_posts()) {

      $p = $query->next_post();

      // Get values from acf repeater fileds
      // http://www.advancedcustomfields.com/resources/get_fields
      //
      // Example:
      //
      // $custom_fields = get_fields($p->ID);
      // $dates = $acf_fields['acf_repeater_field'][0];
      // 'output_name' => $dates['acf_sub_field'],

      // Get and format event start and end dates (month, day)
      $date_started = strtotime(get_field('date_started',$p->ID));
      $date_ended = strtotime(get_field('date_ended',$p->ID));

      // Get post taxonomies
      $timelines = get_the_terms( $p->ID , 'event_timeline' );
      $eras = get_the_terms( $p->ID , 'event_era' );
      $types = get_the_terms( $p->ID , 'event_type' );
      $groups = get_the_terms( $p->ID , 'event_group' );
      $topics = get_the_terms( $p->ID , 'event_topic' );
      $tags = get_the_terms( $p->ID , 'event_tag' );

      // Output event attributes
      $output[] = array(
        'id'                    => $p->ID,
        'permalink'             => get_permalink( $p->ID ),
        'title'                 => $p->event_title,
        'subtitle'              => $p->event_subtitle,

        'display_date'          => $p->display_date,

        // Event start date
        'year_event_started'    => $p->year_started,
        'month_event_started'   => date('F', $date_started),
        'day_event_started'     => date('d', $date_started),

        // Event end date
        'year_event_ended'      => $p->year_ended,
        'month_event_ended'     => date('F', $date_ended),
        'day_event_ended'       => date('d', $date_ended),

        // Event taxonomy terms
        'timelines'             => $this->terms_array($timelines),
        'eras'                  => $this->terms_array($eras),
        'types'                 => $this->terms_array($types),
        'groups'                => $this->terms_array($groups),
        'topics'                => $this->terms_array($topics),
        'tags'                  => $this->terms_array($tags),

      );

    }

    return $output;

  }

}
