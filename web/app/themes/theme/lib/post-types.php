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

  $singular = 'Event';
  $plural   = 'Events';
  $slug     = 'history/events';

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
    'supports'          => false,
    'labels'            => $labels,
    'menu_position'     => 6, // menu order overwritten in admin-cp.php
    'menu_icon'         => 'dashicons-clock',
    'show_ui'           => true,
    'query_var'         => true,
    'public'            => true
  );

  register_post_type( 'events', $args );


  // Custom post type: Story

  $singular = 'Story';
  $plural   = 'Stories';
  $slug     = 'stories';

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
    'supports'          => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
    'labels'            => $labels,
    'menu_position'     => 6, // menu order overwritten in admin-cp.php
    'menu_icon'         => 'dashicons-format-status',
    'show_ui'           => true,
    'query_var'         => true,
    'public'            => true
  );

  register_post_type( 'stories', $args );

}

// Taxonomies:

function register_taxonomies() {

  // Taxonomy: Event Timelines

  $singular = 'Timeline';
  $plural   = 'Timelines';
  $slug     = 'history/timelines';

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
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'events_timelines', array( 'events' ), $args );


  // Taxonomy: Events Eras

  $singular = 'Era';
  $plural   = 'Eras';
  $slug     = 'history/events/eras';

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
    'labels'            => $labels,
    'show_ui'           => true,
    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'evetns_eras', array( 'events' ), $args );


  // Taxonomy: Event Types

  $singular = 'Type';
  $plural   = 'Types';
  $slug     = 'history/events/types';

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

  register_taxonomy( 'events_types', array( 'events' ), $args );


  // Taxonomy: Events Topics

  $singular = 'Topic';
  $plural   = 'Topics';
  $slug     = 'history/events/topics';

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

  register_taxonomy( 'events_topics', array( 'events' ), $args );


  // Taxonomy: Events Groups

  $singular = 'Group';
  $plural   = 'Groups';
  $slug     = 'history/events/groups';

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

  register_taxonomy( 'events_groups', array( 'events' ), $args );


  // Taxonomy: Stories Formats

  $singular = 'Format';
  $plural   = 'Formats';
  $slug     = 'stories/formats';

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
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'stories_formats', array( 'stories' ), $args );


  // Taxonomy: Stories Categories

  $singular = 'Category';
  $plural   = 'Categories';
  $slug     = 'stories/categories';

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
    'meta_box_cb'       => false, // true to show meta box on post edit page    'meta_box_cb'       => false, // true to show meta box on post edit page
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'stories_categories', array( 'stories' ), $args );


  // Taxonomy: Stories Topics

  $singular = 'Topic';
  $plural   = 'Topics';
  $slug     = 'stories/topics';

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

  register_taxonomy( 'stories_topics', array( 'stories' ), $args );


  // Taxonomy: Tags;
  // Shared beetween Events and Stories

  $singular = 'Tag';
  $plural   = 'Tags';
  $slug     = 'tags';

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

  register_taxonomy( 'global_tag', array( 'events', 'stories' ), $args );
}