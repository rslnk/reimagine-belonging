<?php

/*

  WordPress admin panel modifications
  -----------------------------------

  * Clean up WordPress admin toolbar
  * Clean up WordPress dashboard
  * Register 'Site' option pages
  * Clean up WordPress admin menu
  * Rename default WordPress admin menu items
  * Customize WordPress admin menu items order
  * Change post thumbnail meta box title to 'Preview image'
  * Change story default post format to 'video'
  * Hide WordPress default description filed on 'event_timeline' taxonomy terms edit page
  * Customize admin columns for posts, pages, events and stories

*/

// Remove WordPress admin toolbar when viewing site (all users)
add_filter('show_admin_bar', '__return_false');

// Clean up WordPress admin toolbar
add_action( 'wp_before_admin_bar_render', 'cleanup_admin_toolbar' );

function cleanup_admin_toolbar() {
  global $wp_admin_bar;
  $wp_admin_bar->remove_menu('wp-logo'); // Hide WordPress logo
  $wp_admin_bar->remove_menu('comments'); // Hide comments icon
}

// Clean up WordPress dashboard
add_action('wp_dashboard_setup', 'dashboard_cleanup', 999);

function dashboard_cleanup() {
  global $wp_meta_boxes;
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
  unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
  unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
}

/*

  Register options pages
  ----------------------

  acf_add_options_page() function will add a new options page to the wp-admin sidebar.

  Important!

  All data saved on an options page is global. This means it saved in the wp_options table.
  Must be used before the action admin_menu (priority 99) as this is when the options pages are added to WordPress.

  Requires ACF PRO version >= 5.0.0

  Registered pages
  ================

  * Site options page
    ** Footer
    ** 404 page

 */

if ( function_exists('acf_add_options_page') ) {

  acf_add_options_page(array(
    'page_title'  => 'Site settings',
    'menu_title'  => 'Settings',
    'menu_slug'   => 'site-settings',
    'capability'  => 'edit_pages',
    'icon_url'    => 'dashicons-admin-settings',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Templates',
    'menu_title'  => 'Templates',
    'parent_slug' => 'site-settings',
    'capability'  => 'edit_pages'
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Dictionary',
    'menu_title'  => 'Dictionary',
    'parent_slug' => 'site-settings',
    'capability'  => 'edit_pages'
  ));
}

// Clean up WordPress admin menu
add_action( 'admin_menu', 'hide_amdin_menu_items' );

function hide_amdin_menu_items()
{
  remove_menu_page('index.php'); // Hide Dashboard
  remove_menu_page('edit-comments.php');
  remove_menu_page('tools.php');

  /*

    If user is an editor:

      1) Give permissions to edit theme options
      2) Hide theme options menu
      3) Hide ACF PRO custom fields menu
      4) Create 'Edit menus' subpage under Site Options page

  */

  global $user_ID;

  $user = wp_get_current_user();
  if ( in_array( 'editor', (array) $user->roles ) ) {

    add_filter( 'user_has_cap', 'give_permission' );
    function give_permission( $caps ) {
      $caps[ 'edit_theme_options' ] = true;
      return $caps;
    }

    remove_menu_page('themes.php');
    remove_menu_page('edit.php?post_type=acf-field-group');
    add_submenu_page('site-options', 'Edit menus', 'Menus', 'edit_pages', 'nav-menus.php', '');
  }

}

// Rename default WordPress admin menu items
add_action( 'admin_menu', 'rename_admin_menus' );

function rename_admin_menus() {
    global $menu;
    $menu[5][0]   = 'News';      // Change 'Posts' to 'News'
    $menu[80][0]  = 'WordPress'; // Change 'Settings' to 'WordPress'
}

// Customize WordPress admin menu items order
add_filter( 'custom_menu_order', '__return_true' );
add_filter( 'menu_order', 'change_menu_order' );

function change_menu_order( $menu_order ) {
  if (!$menu_order) return true;

  return array(
      'index.php',
      'edit.php', // blog posts
      'edit.php?post_type=event',
      'edit.php?post_type=story',
      'edit.php?post_type=page',
      'separator1',
      'upload.php',
      'separator2',
      'site-settings', // ACF PRO options page
      'separator-last',
      'profile.php',
  );

}

// Change post thumbnail meta box title to 'Preview image'
add_action( 'add_meta_boxes', 'change_featured_image_meta_box_title', 10, 2 );

function change_featured_image_meta_box_title( $post_type, $post ) {
  $post_types = array ( 'post', 'event', 'story' );
  // remove original thumbnail image metabox
  remove_meta_box( 'postimagediv', '', 'side' );
  // add customized metabox
  add_meta_box( 'postimagediv', __('Preview Image'), 'post_thumbnail_meta_box', '', 'side', 'high' );
}

// Change story default post format to 'video'
add_filter( 'option_default_post_format', 'story_default_post_format', 10, 1 );

function story_default_post_format( $format ) {
  global $post_type;
  return ( $post_type == 'story' ? 'video' : $format );
}

// Hide WordPress default description filed on 'event_timeline' taxonomy terms edit page
add_action( 'admin_footer-edit-tags.php', 'remove_taxonomy_tag_description' );

function remove_taxonomy_tag_description(){
  global $current_screen;
  switch ( $current_screen->id )
  {
    case 'edit-category':
      // WE ARE AT /wp-admin/edit-tags.php?taxonomy=category
      // OR AT /wp-admin/edit-tags.php?action=edit&taxonomy=category&tag_ID=1&post_type=post
      break;
  }
  ?>
  <script type="text/javascript">
  jQuery(document).ready( function($) {
      $('#tag-description').parent().remove();
  });
  </script>
  <?php
}

/*

Customize admin colums
----------------------

* Add preview image and year columns to events posts list
* Set columns css width and styles in edit.php
* Register sortable columns
* Sort event columns by year
* Remove comments column from posts and pages

*/

add_filter( 'manage_event_posts_columns', 'events_columns_filter', 10, 1 );

add_action( 'manage_event_posts_custom_column', 'add_events_columns', 10, 1 );
add_action( 'admin_enqueue_scripts', 'post_admin_column_resize' );

add_filter( 'manage_edit-event_sortable_columns', 'register_sortable_columns' );
add_action( 'load-edit.php', 'sort_columns' );

add_action( 'manage_posts_columns', 'remove_posts_comments_columns' );
add_action( 'manage_pages_columns', 'remove_posts_comments_columns' );

// Filter events columns
function events_columns_filter( $columns ) {
  $column_thumbnail = array( 'thumbnail_column' => 'Image' );
  $column_start_year = array( 'start_year_column' => 'Year' );
  $columns = array_slice( $columns, 0, 1, true ) + $column_thumbnail + array_slice( $columns, 1, NULL, true );
  $columns = array_slice( $columns, 0, 2, true ) + $column_start_year + array_slice( $columns, 2, NULL, true );
  return $columns;
}

// Add event post type admin columns
function add_events_columns( $column ) {
  global $post;
  switch ( $column ) {
    case 'thumbnail_column':
      echo get_the_post_thumbnail( $post->ID, 'thumbnail' );
      break;
    case 'start_year_column':
      // Get and format event start and end dates (month, day)
      $event_date = strtotime(get_field('start_date',$post->ID));
      $event_year = date('Y', $event_date);
      echo $event_year;
      break;
  }
}

// Set columns size and styles
function post_admin_column_resize() { ?>
  <style type="text/css">
    .edit-php .fixed .column-start_year_column { width: 65px; white-space: nowrap; font-weight: bold; }
    .edit-php .fixed .column-thumbnail_column { width: 50px; }
    .edit-php .fixed .thumbnail_column img { width: 50px; height: 50px; }
    .edit-php .fixed .column-taxonomy-event_timeline { width: 15%; }
    .edit-php .fixed .column-taxonomy-event_era { width: 12%; }
    .edit-php .fixed .column-taxonomy-event_topic { width: 20%; }
  </style>
<?php }

// Remove comments column from posts admin
function remove_posts_comments_columns( $columns ) {
    unset( $columns[ 'comments' ] );
    return $columns;
}

// Register sortable admin columns
function register_sortable_columns( $post_columns ) {
  $post_columns = [
    'start_year_column' => 'start_date',
    'topic_column' => 'event_topic',
    'era_column' => 'event_era'
  ];
  return $post_columns;
}

// Sort columns
function sort_columns() {
  add_filter( 'request', 'sort_columns_by_custom_values' );
}

// Sort event posts by values in sortable admin columns
function sort_columns_by_custom_values( $vars ) {

  // Check if viewing the 'event' post type
  if ( isset( $vars['post_type'] ) && 'event' == $vars['post_type'] ) {

    // Sort by year column
    if ( isset( $vars['orderby'] ) && 'start_date' == $vars['orderby'] ) {

      // Merge the query vars with our custom variables
      $vars = array_merge(
        $vars,
        array(
          'meta_key' => 'start_date',
          'orderby' => 'meta_value_num'
        )
      );
    }
  }
  return $vars;
}