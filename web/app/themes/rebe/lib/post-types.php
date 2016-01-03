<?php

namespace Theme\Lib\PostTypes;

/*

  # Custom post types

  ## Post Types

  Event:           'post_type' => 'event'
  Story:           'post_type' => 'story'

  ## Post types slugs

  Events and stories post types slugs are set in WordPress Site Settings under Advanced menu
  We're using GetEventPostTypeSlug() and GetStoryPostTypeSlug() functions to get them.

*/


function GetEventPostTypeSlug() {
  // Get Event post slug
  // Check if slug base is set and merge it with the post slug
  if (get_field('event_post_type_slug_base', 'option')) {
    $events_slug = get_field('event_post_type_slug_base', 'option') . '/' . get_field('event_post_type_slug', 'option');
    return $events_slug;
  }
  else {
    $events_slug = get_field('event_post_type_slug', 'option');
    return $events_slug;
  }
}

function GetStoryPostTypeSlug() {
  // Get Story post type slug
  $stories_slug = get_field('story_post_type_slug', 'option');
  return $stories_slug;
}

// Register Post types
add_action( 'init', __NAMESPACE__ . '\\register_post_types' );

// Post type `Event`
function register_post_types() {

  $post_type      = 'event';
  $slug           = GetEventPostTypeSlug();

  $supported_ui   = ['title', 'thumbnail']; // false to hide all default WordPress post editing UI

  // **Note on event slug**

  // Event post slugs and slug base should be on Site settings page
  // Event **slug base** e.g. "history" is used for better semantics of the event URL
  // E.g. naming a slug base 'history' and event slug 'events' will result in 'history/events'.
  // Event **slug base** is also used as a slug for event post type taxonomies. E.g. 'history/taxonomy/taxomomy-term'.

  // Labels
  $singular       = 'Event';
  $plural         = 'Events';

  $labels = [
    'name'                        => __( $plural ),
    'singular_name'               => __( $singular ),
    'menu_name'                   => __( $plural ),
    'name_admin_bar'              => __( $singular ),
    'add_new'                     => __( 'Add ' . $singular ),
    'add_new_item'                => __( 'Add New ' . $singular ),
    'new_item'                    => __( 'New ' . $singular ),
    'edit_item'                   => __( 'Edit ' . $singular ),
    'view_item'                   => __( 'View ' . $singular ),
    'all_items'                   => __( 'All ' . $plural ),
    'search_items'                => __( 'Search ' . $plural ),
    'parent_item_colon'           => __( 'Parent ' . $plural . ':' ),
    'not_found'                   => __( 'No ' . $plural . ' found.' ),
    'not_found_in_trash'          => __( 'No ' . $plural . ' found in Trash.' )
  ];

  $args = [
    'has_archive'                 => false, // set 'true' to use archive-post-type.php template
    'public'                      => true,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'supports'                    => $supported_ui,
    'labels'                      => $labels,
    'capability_type'             => 'post',
    'menu_position'               => 6, // menu order overwritten in admin-cp.php
    'menu_icon'                   => 'dashicons-clock',
    'show_ui'                     => true,
  ];

  register_post_type( $post_type, $args );


  // Story

  $post_type      = 'story';

  $slug           = get_field('story_post_type_slug', 'option');
  $supported_ui   = ['title', 'thumbnail', 'post-formats']; // false to hide all default WordPress post editing UI

  // Labels
  $singular       = 'Story';
  $plural         = 'Stories';

  $labels = [
    'name'                        => __( $plural ),
    'singular_name'               => __( $singular ),
    'menu_name'                   => __( $plural ),
    'name_admin_bar'              => __( $singular ),
    'add_new'                     => __( 'Add ' . $singular ),
    'add_new_item'                => __( 'Add New ' . $singular ),
    'new_item'                    => __( 'New ' . $singular ),
    'edit_item'                   => __( 'Edit ' . $singular ),
    'view_item'                   => __( 'View ' . $singular ),
    'all_items'                   => __( 'All ' . $plural ),
    'search_items'                => __( 'Search ' . $plural ),
    'parent_item_colon'           => __( 'Parent ' . $plural . ':' ),
    'not_found'                   => __( 'No ' . $plural . ' found.' ),
    'not_found_in_trash'          => __( 'No ' . $plural . ' found in Trash.' )
  ];

  $args = [
    //'has_archive'                 => false, // set 'true' to use archive-post-type.php template
    'public'                      => true,
    'rewrite'                     => ['slug' => $slug, 'with_front' => false],
    'supports'                    => $supported_ui,
    'labels'                      => $labels,
    'capability_type'             => 'post',
    'menu_position'               => 6, // menu order overwritten in admin-cp.php
    'menu_icon'                   => 'dashicons-format-status',
    'show_ui'                     => true,
  ];

  register_post_type( $post_type, $args );

}
