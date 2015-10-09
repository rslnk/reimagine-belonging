<?php
/*

  # Output all stories posts (for previews)

  Output basic data associated with story post type:

  - Post ID
  - Title
  - Permalink
  - Post format (video, audio, standard)
  - Preview image (post thumbnail)
  - Protagonist name
  - City
  - Taxonomies terms

  NB! Currently there is no pagination solution for API data output.
  Set 'Blog pages show at most ... posts' in WordPress reading option to control amount of entries
  to output in API: http://reimaginebelonging.dev/wp/wp-admin/options-reading.php

*/

namespace BaseSetup\API\Data;

use BaseSetup\API\Data\Filter;
use WP_Query;

function allStoriesPostsPreviews() {

  $dataFilter = new Filter\DataFilter();
  $query = new WP_Query([
    'post_type'                    => 'story',
    'no_found_rows'                => true,   // counts posts, remove if pagination required
    'update_post_term_cache'       => false,  // grabs terms, remove if terms required (category, tag...)
    'update_post_meta_cache'       => false,  // grabs post meta, remove if post meta required
  ]);

  $output = [];

  while ($query->have_posts()) {

    $post = $query->next_post();
    $output[] = [

      // Basic post data
      'id'                         => $post->ID,
      'title'                      => $post->post_title,
      'published_date_gmt'         => $post->post_date_gmt,
      'permalink'                  => get_permalink($post->ID),
      'format'                     => get_post_format($post->ID),
      'preview_image'              => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),
      'preview_image_color'        => $post->color,
      'hero'                       => $post->protagonist_name,
      'city'                       => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID , 'story_city') ),

      // Post taxonomy terms
      'groups'                     => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_group') ),
      'topics'                     => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_topic') ),
      'cities'                     => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_city' ) ),
      'people'                     => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_person') ),
      'tags'                       => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'global_tag') )

    ];

  }

  return $output;
}
