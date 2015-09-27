<?php
/*

  # Output all events posts (for previews)

  Output basic data associated with event post type:

  - Post ID
  - Title
  - Permalink
  - Preview image (post thumbnail)
  - Event date
  - Taxonomies terms

  NB! Currently there is no pagination solution for API data output.
  Set 'Blog pages show at most ... posts' in WordPress reading option to control amount of entries
  to output in API: http://reimaginebelonging.dev/wp/wp-admin/options-reading.php

*/

namespace BaseSetup\API\Data;

use BaseSetup\API\Data\Filter;
use WP_Query;

function allEventsPostsPreviews() {

  $dataFilter = new Filter\DataFilter();
  $query = new WP_Query([
    'post_type'                    => 'event',
    'no_found_rows'                => true,   // counts posts, remove if pagination required
    'update_post_term_cache'       => false,  // grabs terms, remove if terms required (category, tag...)
    'update_post_meta_cache'       => false,  // grabs post meta, remove if post meta required
  ]);

  $output = [];

  while ($query->have_posts()) {

    $post                          = $query->next_post();
    $start_date                    = strtotime( get_field('start_date', $post->ID) );

    $output[] = [

      // Basic post data
      'id'                         => $post->ID,
      'title'                      => $post->post_title,
      'published_date_gmt'         => $post->post_date_gmt,
      'permalink'                  => get_permalink( $post->ID ),
      'preview_image'              => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),
      'start_date'                 => $post->start_date,

      // Event taxonomies terms
      'timelines'                  => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_timeline') ),
      'eras'                       => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_era') ),
      'types'                      => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_type') ),
      'groups'                     => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_group') ),
      'topics'                     => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'event_topic') ),
      'tags'                       => $dataFilter->eventPostTaxonomyTerms( get_the_terms($post->ID, 'global_tag') ),

    ];

  }

  return $output;
}
