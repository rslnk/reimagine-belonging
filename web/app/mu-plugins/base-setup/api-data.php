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
      $start_date = strtotime(get_field('start_date',$p->ID));
      $end_date = strtotime(get_field('end_date',$p->ID));

      // Get post taxonomies
      $timelines = get_the_terms( $p->ID , 'event_timeline' );
      $eras = get_the_terms( $p->ID , 'event_era' );
      $types = get_the_terms( $p->ID , 'event_type' );
      $groups = get_the_terms( $p->ID , 'event_group' );
      $topics = get_the_terms( $p->ID , 'event_topic' );
      $tags = get_the_terms( $p->ID , 'global_tag' );

      // Get WordPress post thumbnail URL (full image)
      $preview_image_id = get_post_thumbnail_id( $p->ID );
      $preview_image_url = wp_get_attachment_url($preview_image_id);

      // Output event attributes
      $output[] = array(
        'id'                    => $p->ID,
        'title'                 => $p->post_title,
        'post_date_gmt'         => $p->post_date_gmt,
        'subtitle'              => $p->subtitle,
        'permalink'             => get_permalink( $p->ID ),

        'preview_image'         => $preview_image_url,

        'display_date'          => $p->display_dates,

        // Event start date
        'year_event_started'    => $p->start_year,
        'month_event_started'   => date('F', $start_date),
        'day_event_started'     => date('d', $start_date),

        // Event end date
        'year_event_ended'      => $p->end_year,
        'month_event_ended'     => date('F', $end_date),
        'day_event_ended'       => date('d', $end_date),

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
