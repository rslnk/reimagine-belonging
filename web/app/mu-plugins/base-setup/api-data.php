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
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;

$output = null;
$api = new API_Data();

switch ($action) {

  case 'list-all-events':
    $output = $api->list_all_events();
    break;

  case 'list-all-stories':
    $output = $api->list_all_events();
    break;

  case 'event-data':
    $output = $api->event_data($id);
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

class DataFilter {
  public static function eventSidebarContent ($content) {
    $result = array();

    foreach ($content as $item) {
      switch ($item['sidebar_content_type']){
        case 'image':
          $i = $item['image'][0];
          $i['type'] = 'image';
          $result[] = $i;
          break;
        case 'quote':
          $i = $item['quote'][0];
          $i['type'] = 'quote';
          $result[] = $i;
          break;
        case 'sidenote':
          $i = $item['sidenote'][0];
          $i['type'] = 'sidenote';
          $result[] = $i;
          break;
        case 'event':
          $i = [];
          $post = $item['related_event'][0];
          $i['title'] = $post->post_title;
          $i['type'] = 'event';
          $result[] = $i;
          break;
        case 'story':
          // run over getting posts data here
          $i = [];
          $post = $item['related_story'][0];
          $i['title'] = $post->post_title;
          $i['type'] = 'story';
          $result[] = $i;
          break;
        case 'youtube_video':
          $i = $item['youtube_video'][0];
          $i['type'] = 'youtube_video';
          $result[] = $i;
          break;
        case 'oembed';
          $i = $item['oembed_video'][0];
          $i['type'] = 'oembed';
          $result[] = $i;
          break;
      }
    }

    return $result;
  }

  public static function sources ($sources) {
    $result = array();
    foreach ($sources as $source) {
      $result[] = $source;
    }
    return $result;
  }

  public static function resources ($resources) {
    $result = array();
    foreach ($resources as $resource) {
      $result[] = $resource;
    }
    return $result;
  }
}

class API_Data {
  function __construct () {
    $this->dataFilter = new DataFilter();
  }

  // List taxonomy terms
  function terms_array($terms) {
    $arr = array();
    if ( !empty( $terms ) ) {
      foreach ( $terms as $term ) {
        $arr[] = array(
          'term_name'  => $term->name,
          'term_slug'  => $term->slug,
          'term_color' => get_field('taxonomy_term_color',  $term)
        );
      }
      return $arr;
    }
  }

  // List post data array for related posts output
  function post_data_array($posts) {
    $arr = array();
    if ( !empty( $posts ) ) {
      foreach ( $posts as $post ) {

        // Get WordPress post thumbnail URL (full image)
        $preview_image_id = get_post_thumbnail_id( $post->ID );
        $preview_image_url = wp_get_attachment_url($preview_image_id);

        $arr[] = array(
          'post_id'            => $post->ID,
          'post_title'         => $post->post_title,
          'post_slug'          => get_permalink( $post->ID ),
          'event_start_year'   => $post->start_year,
          'story_hero'         => $post->hero,
          'hero_age'           => $post->age,
          'hero_city'          => $post->city,
          'post_preview_image' => $preview_image_url

        );
      }
      return $arr;
    }
  }

  // Output all event posts previews
  function list_all_events() {

    $query = new WP_Query(array(
      'post_type' => 'event',
      'no_found_rows' => true, // counts posts, remove if pagination required
      'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
      'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
    ));

    $output = array();

    while ($query->have_posts()) {

      $post = $query->next_post();

      // Get and format event start and end dates (month, day)
      $start_date = strtotime(get_field('start_date',$post->ID));
      $end_date = strtotime(get_field('end_date',$post->ID));

      // Get post taxonomies
      $timelines = get_the_terms( $post->ID , 'event_timeline' );
      $eras = get_the_terms( $post->ID , 'event_era' );
      $types = get_the_terms( $post->ID , 'event_type' );
      $groups = get_the_terms( $post->ID , 'event_group' );
      $topics = get_the_terms( $post->ID , 'event_topic' );
      $tags = get_the_terms( $post->ID , 'global_tag' );

      // Get WordPress post thumbnail URL (full image)
      $preview_image_id = get_post_thumbnail_id( $post->ID );
      $preview_image_url = wp_get_attachment_url($preview_image_id);

      // Output event attributes
      $output[] = array(

        // Basic post data
        'event_id'                    => $post->ID,
        'event_title'                 => $post->post_title,
        'event_published_date_gmt'    => $post->post_date_gmt,
        'event_subtitle'              => $post->subtitle,
        'event_permalink'             => get_permalink( $post->ID ),
        'event_preview_image'         => $preview_image_url,

        // Event dates
        'display_event_date'    => $post->display_dates,
        'event_start_year'      => $post->start_year,
        'event_start_month'     => date('F', $start_date),
        'event_start_date'      => date('d', $start_date),
        'event_end_year'        => $post->end_year,
        'event_end_month'       => date('F', $end_date),
        'event_start_date'      => date('d', $end_date),

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

  // Output event post
  function event_data ($id) {
    if ($id === 0) return false;

    $output = array();

    $post_id = $id;
    $post = get_post($post_id);


    // Get and format event start and end dates (month, day)
    $start_date = strtotime(get_field('start_date',$post->ID));
    $end_date = strtotime(get_field('end_date',$post->ID));

    // Get post taxonomies
    $timelines = get_the_terms( $post->ID , 'event_timeline' );
    $eras = get_the_terms( $post->ID , 'event_era' );
    $types = get_the_terms( $post->ID , 'event_type' );
    $groups = get_the_terms( $post->ID , 'event_group' );
    $topics = get_the_terms( $post->ID , 'event_topic' );
    $tags = get_the_terms( $post->ID , 'global_tag' );

    // Get WordPress post thumbnail URL (full image)
    $preview_image_id = get_post_thumbnail_id( $post->ID );
    $preview_image_url = wp_get_attachment_url($preview_image_id);

    // Get all custom fields attached to the post that are not starting from '_'
    // http://www.advancedcustomfields.com/resources/get_fields
    $custom_fields = get_fields($post->ID);

    // Repeater fileds:
    $header_image = $custom_fields['header_image'][0];
    $sidebar_content = $custom_fields['sidebar_content'][0];
    $post_source = $custom_fields['sources'][0];
    $post_resource = $custom_fields['resources'][0];


    // Output event attributes
    $output[] = array(

      // Basic post data
      'event_id'                           => $post->ID,
      'event_title'                        => $post->post_title,
      'event_published_date_gmt'           => $post->post_date_gmt,
      'event_subtitle'                     => $post->subtitle,
      'event_permalink'                    => get_permalink( $post->ID ),
      'event_authors'                      => $post->authors,
      'event_preview_image'                => $preview_image_url,

      // Event dates
      'display_event_date'                 => $post->display_dates,
      'event_start_year'                   => $post->start_year,
      'event_start_month'                  => date('F', $start_date),
      'event_start_date'                   => date('d', $start_date),
      'event_end_year'                     => $post->end_year,
      'event_end_month'                    => date('F', $end_date),
      'event_start_date'                   => date('d', $end_date),

      // Post taxonomy terms
      'timelines'                          => $this->terms_array($timelines),
      'eras'                               => $this->terms_array($eras),
      'types'                              => $this->terms_array($types),
      'groups'                             => $this->terms_array($groups),
      'topics'                             => $this->terms_array($topics),
      'tags'                               => $this->terms_array($tags),

      // Header
      'display_header_image'               => $post->display_header_image,
      'header_image_url'                   => $header_image['url'],
      'header_image_credit'                => $header_image['credit'],
      'header_image_credit_link'           => $header_image['credit_link'],
      'display_header_image_overlay'       => $header_image['display_image_overlay'],
      'header_image_overlay_opacity'       => $header_image['overlay_opacity'],

      // Main content
      'event_main_content'                 => $post->main_content,

      'sidebar'                            => $this->dataFilter->eventSidebarContent(get_field('sidebar_content', $post->ID)),
      'sources'                            => $this->dataFilter->sources(get_field('sources', $post->ID)),
      'resources'                          => $this->dataFilter->resources(get_field('resources', $post->ID)),

      // Related posts
      /* 'related_posts'                      => $this->dataFilter->relatedPosts(get_field('related_posts', $post->ID)); */


    );

  return $output;

  }

}
