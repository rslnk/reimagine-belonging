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

  case 'event-data':
    $output = $api->event_data();
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
  function event_data() {

    $output = array();

    $post_id = 5;
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

    // Nested repeater fileds:
    $sidebar_image = get_sub_field('image');
    $sidebar_quote = get_sub_field('quote');
    $sidebar_sidenote = get_sub_field('sidenote');
    $sidebar_youtube_video = get_sub_field('youtube_video');
    $sidebar_oembed_video = get_sub_field('oembed_video');
    $sidebar_related_event = get_sub_field('related_event');
    $sidebar_related_story = get_sub_field('related_story');

    // Sidebar related posts
    $related_event = get_sub_field( 'related_event', $post->ID );
    $related_story = get_sub_field( 'related_story', $post->ID );

    // Related posts
    $related_events = get_field( 'related_events', $post->ID );
    $related_stories = get_field( 'related_stories', $post->ID );

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

      // Sidebar Image
      'sidebar_image_url'                  => $sidebar_image['url'],
      'sidebar_image_title'                => $sidebar_image['title'],
      'sidebar_image_caption'              => $sidebar_image['caption'],
      'display_image_credit'               => $sidebar_image['display_credit'],
      'sidebar_image_credit'               => $sidebar_image['credit'],
      'sidebar_image_credit_link'          => $sidebar_image['credit_link'],

      // Sidebar Quote
      'sidebar_quote_text'                 => $sidebar_quote['text'],
      'sidebar_quoute_author'              => $sidebar_quote['author'],
      'sidebar_quoute_source'              => $sidebar_quote['source'],

      // Sidebar Sidenote
      'sidebar_sidenote_text'              => $sidebar_sidenote['title'],
      'sidebar_sidenote_caption'           => $sidebar_sidenote['caption'],

      // Sidebar related posts
      'sidebar_related_story'              => $this->post_data_array($related_story),
      'sidebar_related_event'              => $this->post_data_array($related_event),

      // Sidebar YouTube video
      'sidebar_youTube_video_ID'                => $sidebar_youtube_video['id'],
      'sidebar_youTube_video_title'             => $sidebar_youtube_video['title'],
      'sidebar_youTube_video_caption'           => $sidebar_youtube_video['caption'],
      'display_youTube_video_credit'            => $sidebar_youtube_video['display_credit'],
      'sidebar_youTube_video_credit'            => $sidebar_youtube_video['credit'],
      'sidebar_youTube_video_credit_link'       => $sidebar_youtube_video['credit_link'],

      // Sidebar oEmbed video
      'sidebar_oEmbed_video_URL'                => $sidebar_oembed_video['id'],
      'sidebar_oEmbed_video_hide_controls'      => $sidebar_oembed_video['hide_controls'],
      'sidebar_oEmbed_video_autohide_controls'  => $sidebar_oembed_video['autohide_controls'],
      'sidebar_oEmbed_video_hd_quality'         => $sidebar_oembed_video['hd_video_quality'],
      'sidebar_oEmbed_video_title'              => $sidebar_oembed_video['title'],
      'sidebar_oEmbed_video_caption'            => $sidebar_oembed_video['caption'],
      'display_oEmbed_video_credit'             => $sidebar_oembed_video['display_credit'],
      'sidebar_oEmbed_video_credit'             => $sidebar_oembed_video['credit'],
      'sidebar_oEmbed_video_credit_link'        => $sidebar_oembed_video['credit_link'],

      // Related posts
      'related_stories'                    => $this->post_data_array($related_stories),
      'related_events'                     => $this->post_data_array($related_events),

      // Sources
      'source_title'                       => $post_source['title'],
      'source_authors'                     => $post_source['authors'],
      'source_editors_translators'         => $post_source['editors_translators'],
      'source_periodical_title'            => $post_source['periodical_title'],
      'source_location'                    => $post_source['location'],
      'source_publisher'                   => $post_source['publisher'],
      'source_publish date'                => $post_source['date_published'],
      'source_pages'                       => $post_source['pages'],
      'source_edition'                     => $post_source['pages'],
      'source_isbn'                        => $post_source['isbn'],
      'source_date_accessed'               => $post_source['isbn'],
      'source_date_accessed'               => $post_source['url'],

      // Resources
      'resource_title'                     => $post_resource['title'],
      'resource_caption'                   => $post_resource['caption'],
      'resource_authors'                   => $post_resource['authors'],
      'resource_editors_translators'       => $post_resource['editors_translators'],
      'resource_periodical_title'          => $post_resource['periodical_title'],
      'resource_location'                  => $post_resource['location'],
      'resource_publisher'                 => $post_resource['publisher'],
      'resource_publish_date'              => $post_resource['date_published'],
      'resource_pages'                     => $post_resource['pages'],
      'resource_edition'                   => $post_resource['pages'],
      'resource_isbn'                      => $post_resource['isbn'],
      'resource_date_accessed'             => $post_resource['isbn'],
      'resource_date_accessed'             => $post_resource['url']

    );

  return $output;

  }

}
