<?php
/*

* Custom post types and taxonomies

* Post Types:
*
* Events             Historical events
* Sories             Personal stories
*
* Taxonomies:
*
* Events:           Timelines
* Events:           Events Topics
* Stories:          Stories Topics
* Shared taxonomy:  Tags

*/

add_action( 'init', 'register_post_types' );
add_action( 'init', 'register_taxonomies' );

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
    'supports'          => array( 'title', 'editor', 'thumbnail', 'page-attributes' ),
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




function register_taxonomies() {

  // Taxonomy: Timelines
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
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'timelines', array( 'events' ), $args );

  // Taxonomy: Event Types
  $singular = 'Type';
  $plural   = 'Types';
  $slug     = 'history/events/types';

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
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'events_types', array( 'events' ), $args );

  // Taxonomy: Eras
  $singular = 'Era';
  $plural   = 'Eras';
  $slug     = 'history/eras';

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
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'eras', array( 'events' ), $args );

  // Taxonomy: Events Topics
  $singular = 'Topic';
  $plural   = 'Topics';
  $slug     = 'history/topics';

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
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'rewrite'           => array('slug' => $slug, 'with_front' => false)
  );

  register_taxonomy( 'events_topics', array( 'events' ), $args );


  // Taxonomy: Stories Topics
  $singular = 'Topic';
  $plural   = 'Topics';
  $slug     = 'stories/topics';

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
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
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
    'labels'                => $labels,
    'show_ui'               => true,
    'show_admin_column'     => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => $slug ),
  );

  register_taxonomy( 'global_tag', array( 'events', 'stories' ), $args );
}