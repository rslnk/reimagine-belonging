<?php
/*

WordPress admin panel modifications

* Clean up WordPress admin toolbar
* Clean up WordPress dashboard
* Register Site option pages
* Clean up WordPress admin menu
* Rename default WordPress admin menu items
* Customize WordPress admin menu items order

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
    'page_title'  => 'Site options',
    'menu_title'  => 'Site',
    'menu_slug'   => 'site-options',
    'capability'  => 'edit_pages',
    'icon_url'    => 'dashicons-admin-settings',
    'redirect'    => false
  ));

  acf_add_options_sub_page(array(
    'page_title'  => 'Footer',
    'menu_title'  => 'Footer',
    'parent_slug' => 'site-options',
    'capability'  => 'edit_pages'
  ));

  acf_add_options_sub_page(array(
    'page_title'  => '404 page',
    'menu_title'  => '404 Page',
    'parent_slug' => 'site-options',
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
      'edit.php?post_type=history',
      'edit.php?post_type=stories',
      'edit.php?post_type=page',
      'separator1',
      'upload.php',
      'separator2',
      'site-options', // ACF PRO options page
      'separator-last',
      'profile.php',
  );

}