<?php
/*

  # Output single 'event' post data

  Output all data associated with a single post of a 'event' post type

*/

namespace BaseSetup\API\Data;

use BaseSetup\API\Data\Filter;

function eventSinglePost($id, $path) {

  if (!$id && !$path) return false;

  if ($id) {
    $post_id        = $id;
    $post           = get_post($post_id);
  }
  else if ($path) {
    $args = [
      'name'          => $path,
      'post_type'     => 'event',
      'numberposts'   => 1
    ];
    $posts            = get_posts($args);
    $post             = $posts[0];
  }

  $dataFilter = new Filter\DataFilter();

  // Get all custom fields attached to the post that are not starting from '_'
  // http://www.advancedcustomfields.com/resources/get_fields
  $custom_fields = get_fields($post->ID);

  // Check if header repeater filed has subfields:
  if ( !empty (get_field('header_image')) ) {
    $header_image = $custom_fields['header_image'];
  }
  else {
    $header_image = null;
  }

  $output = [

    // Basic post data
    'id'                                     => $post->ID,
    'title'                                  => $post->post_title,
    'published_date_gmt'                     => $post->post_date_gmt,
    'subtitle'                               => $post->subtitle,
    'permalink'                              => get_permalink($post->ID),
    'authors'                                => $post->authors,
    'preview_image'                          => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),

    // Event dates
    'start_date'                             => $post->start_date,
    'end_date'                               => $post->end_date,
    'exact_dates_uknown'                     => $post->unknown_date,

    // Post taxonomy terms
    'timelines'                              => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_timeline') ),
    'eras'                                   => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_era') ),
    'types'                                  => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_type') ),
    'groups'                                 => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_group') ),
    'topics'                                 => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_topic') ),
    'tags'                                   => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'global_tag') ),

    // Header
    'display_header_image'                   => $post->display_header_image,
    'header_image'                           => $header_image['url'],
    'header_image_credit'                    => $header_image['credit'],
    'header_image_credit_link'               => $header_image['credit_link'],
    'display_header_image_overlay'           => $header_image['display_image_overlay'],
    'header_image_overlay_opacity'           => $header_image['overlay_opacity'],

    // Main content
    // Note: call needs post ID in order to output tinyMCE content with <p> tags
    'main_content'                           => get_field('main_content', $post->ID),

    // Sidebar
    'sidebar'                                => $dataFilter->eventPostSidebarContent( get_field('sidebar_content', $post->ID) ),

    // Article Sources and Resources
    'sources'                                => $dataFilter->eventPostSources( get_field('sources', $post->ID) ),
    'resources'                              => $dataFilter->eventPostResources( get_field('resources', $post->ID) ),

    // Related posts
    'related_stories'                        => $dataFilter->storyPostPreview( get_field('related_stories', $post->ID) ),
    'related_events'                         => $dataFilter->eventPostPreview( get_field('related_events', $post->ID) )

  ];

  return $output;
}
