<?php

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

          // Get WordPress post thumbnail URL (full image)
          $preview_image_id = get_post_thumbnail_id( $post->ID );
          $preview_image_url = wp_get_attachment_url($preview_image_id);

          $i['title'] = $post->post_title;
          $i['slug'] = get_permalink( $post->ID );
          $i['start_date'] = $post->start_date;
          $i['preview_image'] = $preview_image_url;
          $i['type'] = 'event';
          $result[] = $i;
          break;
        case 'story':
          $i = [];
          $post = $item['related_story'][0];

          // Get WordPress post thumbnail URL (full image)
          $preview_image_id = get_post_thumbnail_id( $post->ID );
          $preview_image_url = wp_get_attachment_url($preview_image_id);

          $i['title'] = $post->post_title;
          $i['slug'] = get_permalink( $post->ID );
          $i['hero'] = $post->hero_name;
          $i['hero_age'] = $post->hero_age;
          $i['hero_city'] = $post->hero_city;
          $i['preview_image'] = $preview_image_url;
          $i['type'] = 'story';
          $result[] = $i;
          break;
        case 'video':
          $i = $item['video'][0];
          $i['type'] = 'video';
          $result[] = $i;
          break;
      }
    }

    return $result;
  }

  public static function eventArticleSources ($sources) {
    if (!$sources) return null;
    $result = array();
    foreach ($sources as $source) {
      $result[] = $source;
    }
    return $result;
  }

  public static function eventArticleResources ($resources) {
    if (!$resources) return null;
    $result = array();
    foreach ($resources as $resource) {
      $result[] = $resource;
    }
    return $result;
  }
}

