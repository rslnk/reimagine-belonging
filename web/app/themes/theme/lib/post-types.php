<?php

/*

  Custom post types and taxonomies
  --------------------------------

  1. Post Types
  ==========

  Event:           'post_type' => 'event'
  Story:           'post_type' => 'story'

  2. Taxonomies
  ==========

  Event Timeline:      event_timeline
  Event Era:           event_era
  Event Type:          event_type
  Event Group:         event_group
  Event Topic:         event_topic

  Story Topic:         story_topic
  Story City:          story_city
  Story Hero:          story_hero
  Story Group:         story_group

  Shared Tags:         global_tag


  * — taxonomy is not public

*/

add_action( 'init', 'register_post_types' );
add_action( 'init', 'register_taxonomies' );


// 1. Post types
// --------------

function register_post_types() {

  // Event
  // =====

  $post_type      = 'event';

  $slug           = get_field('event_post_type_slug_base', 'option') . get_field('event_post_type_slug', 'option');
  $supported_ui   = ['title', 'thumbnail']; // false to hide all default WordPress post editing UI

  // **Note on event slug**

  // Event post slugs and slug base should be on Site settings page
  // Event **slug base** e.g. "history/" is used for better semantics of the event URL
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
  // =====

  $post_type      = 'story';

  $slug           = get_field('story_slug', 'option');
  $supported_ui   = ['title', 'thumbnail']; // false to hide all default WordPress post editing UI

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

/*
  Taxonomies
  ----------

  Note on taxonomies slugs:

  All event taxonomies use the same slug which is used instead of individual taxonomy slug
  For example: defining 'events' slug (note plural case) for all event post taxonomies will result in:

 ../events/united-states            (for 'timeline' taxonomy term)
 ../events/identity-and-belonging   (for 'topic' taxonomy term)


 Defining 'stories' slug for all story post taxonomies will result in:

  ../stories/new-york               (for 'city' taxonomy term)
 ../stories/growing-up              (for 'topic' taxonomy term)

 Note: avoid having identical post type and taxonomy slugs. Use singular slugs for custom post types
 and plural for taxonomies. Eg. 'event' for custom post type and 'events' slug for this post type taxonomies

 Having identical slugs for post types and their taxonomies will result in 'page not found' error.

*/


function register_taxonomies() {

  // Event Timeline
  // ==============

  $taxonomy       = 'event_timeline';
  $slug           = get_field('event_post_type_slug_base', 'option') . get_field('one_slug_for_all_event_post_type_taxonomies', 'option');
  $post_types     = 'event';

  $plural         = 'Timelines';
  $singular       = 'Timeline';

  $labels = [
    'name'                        => __( $plural ),
    'singular_name'               => __( $singular ),
    'search_items'                => __( 'Search ' . $plural ),
    'all_items'                   => __( 'All ' . $plural ),
    'parent_item'                 => __( 'Parent ' . $singular ),
    'parent_item_colon'           => __( 'Parent ' . $singular .':' ),
    'edit_item'                   => __( 'Edit ' . $singular  ),
    'update_item'                 => __( 'Update ' . $singular ),
    'add_new_item'                => __( 'Add New ' . $singular ),
    'new_item_name'               => __( 'New ' . $singular ),
    'menu_name'                   => __( $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => true,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true, 'hierarchical'=> true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Era
  // =========

  // Note: this taxonomy is for internal use only and it is not publicly queryable.

  $taxonomy       = 'event_era';
  $slug           = get_field('event_post_type_slug_base', 'option') . get_field('one_slug_for_all_event_post_type_taxonomies', 'option');
  $post_types     = 'event';

  $singular       = 'Era';
  $plural         = 'Eras';

  $labels = [
    'name'                        => __( $plural ),
    'singular_name'               => __( $singular ),
    'search_items'                => __( 'Search ' . $plural ),
    'all_items'                   => __( 'All ' . $plural ),
    'parent_item'                 => __( 'Parent ' . $singular ),
    'parent_item_colon'           => __( 'Parent ' . $singular .':' ),
    'edit_item'                   => __( 'Edit ' . $singular  ),
    'update_item'                 => __( 'Update ' . $singular ),
    'add_new_item'                => __( 'Add New ' . $singular ),
    'new_item_name'               => __( 'New ' . $singular ),
    'menu_name'                   => __( $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Type
  // ==========

  $taxonomy       = 'event_type';
  $slug           = get_field('event_post_type_slug_base', 'option') . get_field('one_slug_for_all_event_post_type_taxonomies', 'option');
  $post_types     = 'event';

  $singular       = 'Type';
  $plural         = 'Types';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Topic
  // ===========

  $taxonomy       = 'event_topic';
  $slug           = get_field('event_post_type_slug_base', 'option') . get_field('one_slug_for_all_event_post_type_taxonomies', 'option');
  $post_types     = 'event';

  $singular       = 'Topic';
  $plural         = 'Topics';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => true,
    'rewrite'                     => ['slug' => $slug, 'with_front' => false],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Group
  // ===========

  $taxonomy       = 'event_group';
  $slug           = get_field('event_post_type_slug_base', 'option') . get_field('one_slug_for_all_event_post_type_taxonomies', 'option');
  $post_types     = 'event';

  $singular       = 'Group';
  $plural         = 'Groups';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story Topic
  // ===========

  $taxonomy       = 'story_topic';
  $slug           = get_field('one_slug_for_all_story_post_type_taxonomies', 'option');
  $post_types     = 'story';

  $singular       = 'Topic';
  $plural         = 'Topics';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story City
  // ===========

  $taxonomy       = 'story_city';
  $slug           = get_field('one_slug_for_all_story_post_type_taxonomies', 'option');
  $post_types     = 'story';

  $singular       = 'City';
  $plural         = 'Cities';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story Hero
  // ==========

  $taxonomy       = 'story_person';
  $slug           = get_field('one_slug_for_all_story_post_type_taxonomies', 'option');
  $post_types     = 'story';

  $singular       = 'Person';
  $plural         = 'People';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story Group
  // ===========

  $taxonomy       = 'story_group';
  $slug           = get_field('one_slug_for_all_story_post_type_taxonomies', 'option');
  $post_types     = 'story';

  $singular       = 'Group';
  $plural         = 'Groups';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Global Tag
  // ==========

  // Note: this taxonomy is shared beetween event and story post types

  $taxonomy       = 'global_tag';
  $slug           = get_field('global_tag_slug', 'option');
  $post_types     = ['event', 'story'];

  $singular       = 'Tag';
  $plural         = 'Tags';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => true,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'update_count_callback'       => '_update_post_term_count',
    'rewrite'                     => ['slug' => $slug, 'with_front' => true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );
}