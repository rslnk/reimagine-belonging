<?php
/*

  # Output single 'story' post data

  Output all data associated with a single post of a 'story' post type

*/

namespace BaseSetup\API\Data;

use BaseSetup\API\Data\Filter;

function storySinglePost($id, $path) {

  if (!$id && !$path) return false;

  if ($id) {
    $post_id                        = $id;
    $post                           = get_post($post_id);
  }
  else if ($path) {
    $args = [
      'name'                        => $path,
      'post_type'                   => 'story',
      'numberposts'                 => 1
    ];
    $posts                          = get_posts($args);
    $post                           = $posts[0];
  }

  $dataFilter = new Filter\DataFilter();
  $output = [

    // Basic post data
    'id'                              => $post->ID,
    'title'                           => $post->post_title,
    'published_date_gmt'              => $post->post_date_gmt,
    'permalink'                       => get_permalink( $post->ID ),
    'format'                          => get_post_format( $post->ID ),
    'preview_image'                   => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),
    'preview_image_color'             => $post->color,
    'hero'                            => $post->protagonist_name,
    'city'                            => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_city') ),
    'excerpt'                         => $post->excerpt,

    // Post taxonomy terms
    'groups'                          => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_group') ),
    'topics'                          => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_topic') ),
    'cities'                          => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_city') ),
    'people'                          => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'story_person') ),
    'tags'                            => $dataFilter->storyPostTaxonomyTerms( get_the_terms($post->ID, 'global_tag') ),

    // If post format is Video
    'story_video_host'                => $post->story_video_host,
    'story_video_id'                  => $post->story_video_id,
    'story_oembed_video'              => $post->story_oembed_video,
    'subtitles_notification'          => $post->subtitles_notification,

    // If post format is Audio
    'story_oembed_audio'              => $post->story_oembed_audio,

    // If post format is Standart (Text)
    // Note: call needs post ID in order to output tinyMCE content with <p> tags
    'story_text'                      => get_field('text', $post->ID),

    // Related posts
    'related_stories'                 => $dataFilter->storyPostPreview( get_field('related_stories', $post->ID ) ),
    'related_events'                  => $dataFilter->eventPostPreview( get_field('related_events', $post->ID ) )

  ];

  return $output;
}
