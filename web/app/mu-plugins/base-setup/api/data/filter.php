<?php

namespace BaseSetup\API\Data\Filter;

/*

  # Filter certain type of data for cleaner API output

*/

class DataFilter {

  public static function eventPostTaxonomyTerms($terms) {
    $result = [];
    if ( !empty( $terms ) ) {
      foreach ( $terms as $term ) {
        $result[] = [
          'term_name'  => $term->name,
          'term_slug'  => $term->slug,
        ];
      }
      return $result;
    }
  }

  public static function storyPostTaxonomyTerms($terms) {
    $result = [];
    if ( !empty( $terms ) ) {
      foreach ( $terms as $term ) {
        $result[] = [
          'term_name'  => $term->name,
          'term_slug'  => $term->slug,
          'term_color' => get_field('taxonomy_term_color',  $term)
        ];
      }
      return $result;
    }
  }

  public static function eventPostPreview($posts) {
    $result  = [];
    if ( !empty( $posts ) ) {
      foreach ( $posts as $post ) {

        $result[] = [
          'post_id'                => $post->ID,
          'post_title'             => $post->post_title,
          'post_slug'              => get_permalink($post->ID),
          'preview_image'          => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),
          'event_start_year'       => $post->start_date
        ];

      }
      return $result;
    }
  }

  public static function storyPostPreview($posts) {
    $result  = [];
    if ( !empty( $posts ) ) {
      foreach ( $posts as $post ) {

        $result[] = [
          'post_id'                => $post->ID,
          'post_title'             => $post->post_title,
          'post_slug'              => get_permalink($post->ID),
          'format'                 => get_post_format($post->ID),
          'preview_image'          => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) ),
          'preview_image_color'    => $post->color,
          'story_hero'             => $post->protagonist_name,
          'city'                   => self::storyPostTaxonomyTerms( get_the_terms($post->ID , 'story_city') )
        ];
      }
      return $result;
    }
  }

  public static function eventPostSidebarContent ($content) {
    $result = [];
    foreach ($content as $item) {
      switch ($item['sidebar_content_type']){

        case 'image':
          $i                       = $item['image'][0];
          $i['type']               = 'image';
          $result[]                = $i;
          break;

        case 'quote':
          $i                       = $item['quote'][0];
          $i['type']               = 'quote';
          $result[]                = $i;
          break;

        case 'sidenote':
          $i                       = $item['sidenote'][0];
          $i['type']               = 'sidenote';
          $result[]                = $i;
          break;

        case 'event':
          $i                       = [];
          $post                    = $item['related_event'][0];

          $i['title']              = $post->post_title;
          $i['slug']               = get_permalink( $post->ID );
          $i['start_date']         = $post->start_date;
          $i['preview_image']      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
          $i['type']               = 'event';
          $result[]                = $i;
          break;

        case 'story':
          $i                       = [];
          $post                    = $item['related_story'][0];

          $i['title']              = $post->post_title;
          $i['slug']               = get_permalink( $post->ID );
          $i['hero']               = $post->hero_name;
          $i['hero_age']           = $post->hero_age;
          $i['hero_city']          = $post->hero_city;
          $i['preview_image']      = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
          $i['type']               = 'story';
          $result[]                = $i;
          break;

        case 'video':
          $i                       = $item['video'][0];
          $i['type']               = 'video';
          $result[]                = $i;
          break;
      }
    }

    return $result;
  }

  public static function eventPostSources ($sources) {
    if (!$sources) return null;
    $result = [];
    foreach ($sources as $source) {
      $result[] = $source;
    }
    return $result;
  }

  public static function eventPostResources ($resources) {
    if (!$resources) return null;
    $result = [];
    foreach ($resources as $resource) {
      $result[] = $resource;
    }
    return $result;
  }
}
