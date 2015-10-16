<?php

namespace Roots\Sage\Extras;

use Roots\Sage\Setup;

// Add <body> classes
function body_class($classes) {
  // Add page slug if it doesn't exist
  if (is_single() || is_page() && !is_front_page()) {
    if (!in_array(basename(get_permalink()), $classes)) {
      $classes[] = basename(get_permalink());
    }
  }
  return $classes;
}
add_filter('body_class', __NAMESPACE__ . '\\body_class');

// Get Facebook SDK App values from admin
// Output Facebooks JavaScript SDK
function facebook_sdk() {
  if (get_field('facebook_app_id', 'option')) {
    $app_id   = get_field('facebook_app_id', 'option');
    $language = get_field('site_language', 'option');
  echo '<div id="fb-root"></div>';
  echo '<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0]; if (d.getElementById(id)) return; js = d.createElement(s); js.id = id; js.src = "//connect.facebook.net/' . $language . '/sdk.js#xfbml=1&version=v2.3&appId=' . $app_id . '"; fjs.parentNode.insertBefore(js, fjs); }(document, \'script\', \'facebook-jssdk\'));</script>';
  }
}

/*

  List custom taxonomy terms
  --------------------------

  Get taxonomies terms list (without links)
  See "Get terms for all custom taxonomies" section:
  http://codex.wordpress.org/Function_Reference/get_the_terms

*/
function list_categories(){
  global $wp_query, $post;
  // get post by post id
  $post = get_post($post->ID);
  // get post type by post
  $post_type = $post->post_type;
  // get post type taxonomies
  $taxonomies = get_object_taxonomies( $post_type, 'objects' );

  $out = [];
  foreach ($taxonomies as $taxonomy_slug => $taxonomy){
    // get the terms related to post
    $terms = get_the_terms($post->ID, $taxonomy_slug);
    if (!empty($terms)) {
      $out[] = '<ul class="c-categories-chain c-categories-chain--event">';
      foreach ( $terms as $term ) {
        $out[] =
        '<li class="c-categories-chain__item o-btn c-btn--small c-btn--indigo">'
        . $term->name
        . '</li>';
      }
      $out[] = "</ul>";
    }
  }
  echo implode('', $out );
}
