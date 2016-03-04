<?php namespace App;

/**
* Add option pages to admin menu
* Requires ACF PRO >= 5.0.0
* @link http://www.advancedcustomfields.com/resources/acf_add_options_page/
*/
add_action('init', function () {
    if (function_exists('acf_add_options_page')) {
        // Site Settings page
        acf_add_options_page([

            'page_title'  => 'Site settings',
            'menu_title'  => 'Settings',
            'menu_slug'   => 'site-settings',
            'capability'  => 'edit_pages',
            'icon_url'    => 'dashicons-admin-settings',
            'redirect'    => false

        ]);

        // Site Settings/Dictionary
        acf_add_options_sub_page([

            'page_title'  => 'Dictionary',
            'menu_title'  => 'Dictionary',
            'parent_slug' => 'site-settings',
            'capability'  => 'edit_pages'

        ]);

        // Site Settings/Advanced settigns
        acf_add_options_sub_page([

            'page_title'  => 'Advanced settigns',
            'menu_title'  => 'Advanced',
            'parent_slug' => 'site-settings',
            'capability'  => 'activate_plugins'

        ]);
    }
}, 99);

/**
 * Clean up Yoast SEO plugin UI
 */
 add_action('admin_init', function () {
     // Remove plugin notification center from admin
     if (class_exists('Yoast_Notification_Center')) {
         $yoast_nc = \Yoast_Notification_Center::get();
         remove_action('admin_notices', [$yoast_nc, 'display_notifications']);
         remove_action('all_admin_notices', [$yoast_nc, 'display_notifications']);
     }
     // Move plugin metabox to the bottom of the post editor page
     add_filter('wpseo_metabox_prio', function () {
        return 'low';
     });
 });

/**
* Clean up admin menu
* Requires ACF PRO >= 5.0.0
* @link http://www.advancedcustomfields.com/resources/acf_add_options_page/
*/
add_action('admin_menu', function () {

    // Rename admin menu pages
    global $menu;
    $menu[5][0]       = 'News';      // Change 'Posts' to 'News'
    $menu[80][0]      = 'WordPress'; // Change 'Settings' to 'WordPress'

    // Customize admin menu order
    add_filter('custom_menu_order', '__return_true');
    add_filter('menu_order', function () {
        return
        [
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
        ];

    });

    // Hide the following menu pages for all users
    remove_menu_page('index.php');
    remove_menu_page('edit-comments.php');
    remove_menu_page('tools.php');

    // Hide the following menu pages for Editor role
    if (is_user_role('editor')) {
        remove_menu_page('themes.php');
        remove_menu_page('edit.php?post_type=acf-field-group');
    }
});

/**
 * Clean up admin Toolbar
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_before_admin_bar_render
 */
add_action('wp_before_admin_bar_render', function () {
    global $wp_admin_bar;
    // Remove Menu Items from the admin toolbar
    $wp_admin_bar->remove_menu('wp-logo');
    $wp_admin_bar->remove_menu('comments');
    $wp_admin_bar->remove_menu('wpseo-menu');
});

/**
 * Hide admin Toolbar on all front facing pages
 * @link https://codex.wordpress.org/Function_Reference/show_admin_bar
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Clean up Dashboard
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/wp_dashboard_setup
 */
add_action('wp_dashboard_setup', function () {
    global $wp_meta_boxes;
    // Remove Dashboard Widgets
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_activity']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
    unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
    unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
}, 999);

/**
 * Hide post 'Preview' button
 *
 * Since 'Event' and 'Story' post types entries are rendered with AngularJS,
 * previewing the post will result in a blank page, so in order to avoid
 * unnecesary confusion we are hiding post preview buttons.
 */
 add_action('admin_head-post.php', function () {
     global $post_type;
     $post_types = ['event', 'story'];
     if (in_array($post_type, $post_types)) {
         //echo '<style type="text/css">#post-preview {display: none;}</style>';
     }
 });

/**
* Hide post 'Preview' button on newly created post
*/
add_action('admin_head-post-new.php', function () {
    global $post_type;
    $post_types = ['event', 'story'];
    if (in_array($post_type, $post_types)) {
        echo '<style type="text/css">#preview-action {display: none;}</style>';
    }
});

/**
* Add 'Image' and 'Year' admin columns
* Post type 'Events'
*/
add_filter('manage_event_posts_columns', function ($columns) {

    // Set columns and names
    $column_thumbnail   = ['thumbnail_column'   => 'Image'];
    $column_start_year  = ['start_year_column'  => 'Year'];

    // Set thumbnail image column as first column
    $columns = array_slice($columns, 0, 1, true) + $column_thumbnail + array_slice($columns, 1, null, true);
    // Set 'Year' column
    $columns = array_slice($columns, 0, 2, true) + $column_start_year + array_slice($columns, 2, null, true);

    return $columns;

 }, 10, 1);

 /**
 * Add content to the 'Image' and 'Year' admin columns
 * Post type 'Events'
 */
add_action('manage_event_posts_custom_column', function ($column) {

   global $post;

   switch ($column) {
       case 'thumbnail_column':
          // Get post thumbnail
          echo get_the_post_thumbnail($post->ID, 'thumbnail');
          break;
       case 'start_year_column':
          // Get and format Event start and end dates (month, day)
          $event_date = strtotime(get_field('start_date', $post->ID));
          $event_year = date('Y', $event_date);
          echo $event_year;
          break;
   }
}, 10, 1);

/**
* Register sortable admin columns
* Post type 'Events'
*/
add_filter('manage_edit-event_sortable_columns', function ($post_columns) {
    $post_columns = ['start_year_column' => 'start_date'];
    return $post_columns;
});

/**
* Make admin columns sortable by custom values
* Post type 'Events'
*/
add_action('load-edit.php', function () {
    add_filter('request', function ($vars) {
        // Check if viewing the 'event' post type
        if (isset($vars['post_type']) && 'event' == $vars['post_type']) {
            // Sort posts by year
            if (isset($vars['orderby']) && 'start_date' == $vars['orderby']) {
                // Merge the query vars with our custom variables
                $vars = array_merge(
                    $vars,
                        [
                            'meta_key' => 'start_date',
                            'orderby'  => 'meta_value_num'
                        ]
                );
            }
        }
        return $vars;
    });
});

/**
* Add 'Image' admin columns
* Post type 'Story'
*/
add_filter('manage_story_posts_columns', function ($columns) {

    // Set columns and names
    $column_thumbnail = ['thumbnail_column' => 'Image'];

    // Set thumbnail image column as first column
    $columns = array_slice($columns, 0, 1, true) + $column_thumbnail + array_slice($columns, 1, null, true);

    return $columns;

}, 10, 1);

/**
* Add content to the 'Image' admin columns
* Post type 'Story'
*/
add_action('manage_story_posts_custom_column', function ($column) {

    global $post;

    switch ($column) {

        case 'thumbnail_column':
            // Get post thumbnail
            echo get_the_post_thumbnail($post->ID, 'thumbnail');
            break;

    }

}, 10, 1);

/**
* Add syles to admin columns
*/
add_action('admin_enqueue_scripts', function () {
    ?>
        <style type="text/css">
            .edit-php .fixed .column-start_year_column { width: 65px; white-space: nowrap; font-weight: bold; }
            .edit-php .fixed .column-thumbnail_column { width: 50px; }
            .edit-php .fixed .thumbnail_column img { width: 50px; height: 50px; }
            .edit-php .fixed .column-taxonomy-event_timeline { width: 15%; }
            .edit-php .fixed .column-taxonomy-event_era { width: 12%; }
            .edit-php .fixed .column-taxonomy-event_topic { width: 20%; }
        </style>
    <?php
});
