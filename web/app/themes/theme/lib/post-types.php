<?php
/*

* Custom post types and taxonomies

* Post Types:
*
* Events (historical events):   'post_type' => 'events'
* Sories (personal stories):    'post_type' => 'stories'
*
* Taxonomies:
*
* Events Timelines:       events_timelines
* Events Eras:            events_eras
* Events Types:           events_types
* Events Groups:          events_groups
* Events Topics:          events_topics
*
* Stories Formats:        stories_formats
* Stories Categories:     stories_categories
* Stories Topics:         stories_topics
*
* Shared Tags:            global_tags
*

*/

add_action( 'init', 'register_post_types' );
add_action( 'init', 'register_taxonomies' );


// Post types:

function register_post_types() {

  // Custom post type: Event

  $post_type      = 'event';
  $slug           = 'history/events';
  $supported_ui   = false; // hide all default WordPress post editing UI

  $singular   = 'Event';
  $plural     = 'Events';


  $labels = array(
    'name'               => __( $plural ),
    'singular_name'      => __( $singular ),
    'menu_name'          => __( $plural ),
    'name_admin_bar'     => __( $singular ),
    'add_new'            => __( 'Add ' . $singular ),
    'add_new_item'       => __( 'Add New ' . $singular ),
    'new_item'           => __( 'New ' . $singular ),
    'edit_item'          => __( 'Edit ' . $singular ),
    'view_item'          => __( 'View ' . $singular ),
    'all_items'          => __( 'All ' . $plural ),
    'search_items'       => __( 'Search ' . $plural ),
    'parent_item_colon'  => __( 'Parent ' . $plural . ':' ),
    'not_found'          => __( 'No ' . $plural . ' found.' ),
    'not_found_in_trash' => __( 'No ' . $plural . ' found in Trash.' )
  );

  $args = array(
    'hierarchical'      => true,
    'has_archive'       => false, // set 'true' to use archive-post-type.php template
    'capability_type'   => 'post',
    'rewrite'           => array('slug' => $slug, 'with_front' => false),
    'supports'          => $supported_ui,
    'labels'            => $labels,
    'menu_position'     => 6, // menu order overwritten in admin-cp.php
    'menu_icon'         => 'dashicons-clock',
    'show_ui'           => true,
    'query_var'         => true,
    'public'            => true
  );

  register_post_type( $post_type, $args );


  // Custom post type: Story

  $post_type      = 'story';
  $slug           = 'stories';
  $supported_ui   = array( 'post-formats'); // false to hide all default WordPress post editing UI

  $singular   = 'Story';
  $plural     = 'Stories';

  $labels = array(
    'name'               => __( $plural ),
    'singular_name'      => __( $singular ),
    'menu_name'          => __( $plural ),
    'name_admin_bar'     => __( $singular ),
    'add_new'            => __( 'Add ' . $singular ),
    'add_new_item'       => __( 'Add New ' . $singular ),
    'new_item'           => __( 'New ' . $singular ),
    'edit_item'          => __( 'Edit ' . $singular ),
    'view_item'          => __( 'View ' . $singular ),
    'all_items'          => __( 'All ' . $plural ),
    'search_items'       => __( 'Search ' . $plural ),
    'parent_item_colon'  => __( 'Parent ' . $plural . ':' ),
    'not_found'          => __( 'No ' . $plural . ' found.' ),
    'not_found_in_trash' => __( 'No ' . $plural . ' found in Trash.' )
  );

  $args = array(
    'hierarchical'      => true,
    'has_archive'       => false, // set 'true' to use archive-post-type.php template
    'capability_type'   => 'post',
    'rewrite'           => array('slug' => $slug, 'with_front' => false),
    'supports'          => $supported_ui,
    'labels'            => $labels,
    'menu_position'     => 6, // menu order overwritten in admin-cp.php
    'menu_icon'         => 'dashicons-format-status',
    'show_ui'           => true,
    'query_var'         => true,
    'public'            => true
  );

  register_post_type( $post_type, $args );
}

// Taxonomies:

function register_taxonomies() {

  // Taxonomy: Event Timeline
  // This taxonomy is for internal use only and it is not publicly queryable

  $taxonomy     = 'event_timeline';
  //$slug         = 'history/timeline';
  $post_types   = 'event';

  $plural       = 'Timelines';
  $singular     = 'Timeline';

  $labels = array(
    'name'              => __( $plural ),
    'singular_name'     => __( $singular ),
    'search_items'      => __( 'Search ' . $plural ),
    'all_items'         => __( 'All ' . $plural ),
    'parent_item'       => __( 'Parent ' . $singular ),
    'parent_item_colon' => __( 'Parent ' . $singular .':' ),
    'edit_item'         => __( 'Edit ' . $singular  ),
    'update_item'       => __( 'Update ' . $singular ),
    'add_new_item'      => __( 'Add New ' . $singular ),
    'new_item_name'     => __( 'New ' . $singular ),
    'menu_name'         => __( $plural ),
  );

  $args = array(
    'hierarchical'      => true,
    'public'            => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    //'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Event Era
  // This taxonomy is for internal use only and it is not publicly queryable

  $taxonomy     = 'event_era';
  //$slug         = 'history/events/eras';
  $post_types   = 'event';

  $singular = 'Era';
  $plural   = 'Eras';

  $labels = array(
    'name'              => __( $plural ),
    'singular_name'     => __( $singular ),
    'search_items'      => __( 'Search ' . $plural ),
    'all_items'         => __( 'All ' . $plural ),
    'parent_item'       => __( 'Parent ' . $singular ),
    'parent_item_colon' => __( 'Parent ' . $singular .':' ),
    'edit_item'         => __( 'Edit ' . $singular  ),
    'update_item'       => __( 'Update ' . $singular ),
    'add_new_item'      => __( 'Add New ' . $singular ),
    'new_item_name'     => __( 'New ' . $singular ),
    'menu_name'         => __( $plural ),
  );

  $args = array(
    'hierarchical'      => true,
    'public'            => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    //'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Event Type

  $taxonomy     = 'event_type';
  $slug         = 'history/events/types';
  $post_types   = 'event';

  $singular = 'Type';
  $plural   = 'Types';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Event Topic

  $taxonomy     = 'event_topic';
  $slug         = 'history/events/topics';
  $post_types   = 'event';

  $singular = 'Topic';
  $plural   = 'Topics';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'      => false,
    'sort'              => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Event Group

  $taxonomy     = 'event_group';
  $slug         = 'history/events/groups';
  $post_types   = 'event';

  $singular = 'Group';
  $plural   = 'Groups';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'      => false,
    'sort'              => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Story Topic

  $taxonomy     = 'story_topic';
  $slug         = 'stories/topics';
  $post_types   = 'story';

  $singular = 'Topic';
  $plural   = 'Topics';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'      => false,
    'sort'              => true,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Stories Formats
  // This taxonomy is for internal use only and it is not publicly queryable

  $taxonomy     = 'story_format';
  //$slug         = 'stories/formats';
  $post_types   = 'story';

  $singular = 'Format';
  $plural   = 'Formats';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'      => false,
    'public'            => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    //'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Story Group
  // This taxonomy is for internal use only and it is not publicly queryable

  $taxonomy     = 'story_group';
  //$slug         = 'stories/group';
  $post_types   = 'story';


  $singular = 'Group';
  $plural   = 'Groups';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'      => false,
    'public'            => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    //'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( $taxonomy, $post_types, $args );


  // Taxonomy: Global Tag;
  // Shared beetween Events and Stories

  $taxonomy     = 'global_tag';
  $slug         = 'tags';
  $post_types   = array( 'event', 'story' );

  $singular = 'Tag';
  $plural   = 'Tags';

  $labels = array(
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
  );

  $args = array(
    'hierarchical'          => false,
    'sort'                  => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => $slug ),
  );

  register_taxonomy( $taxonomy, $post_types, $args );
}