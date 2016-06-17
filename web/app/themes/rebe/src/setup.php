<?php namespace App;

use ReBe\Routing\RewriteRoutes;
use WPBasic\Navigation\NavWalker;
use WPBasic\Post\PostType;
use WPBasic\Post\Taxonomy;

/**
 * Theme HTTP redirects
 */
add_action('parse_request', function() {
    /**
     * API data endpoints
     * @see `lib/api.php`
    */
    register_api_endpoints();

    /**
     * Rewrite rules for 'story', 'event', 'workshops' post types requests.
     * Mimics Single Page Application behaviour, allowing post-to-post navigation
     * on pages that include Angular applications while stil upadting URL.
     *
     * Switch between 'browser' and 'crawler' to test how requested page/post
     * rendered for diferent user-agents.
    */
    RewriteRoutes::post_type_ui_routing('browser', 'stories');
    RewriteRoutes::post_type_ui_routing('browser', 'events', 'event_timeline');
    RewriteRoutes::post_type_ui_routing('browser', 'workshops');

}, 0);

/**
 * Theme assets
 */
add_action('wp_enqueue_scripts', function () {
    // Main styles
    wp_enqueue_style('rebe/main.css', asset_path('styles/main.css'), false, null);
    // Maing scripts and Angular apps
    wp_enqueue_script('rebe/main.js', asset_path('scripts/main.js'), ['jquery'], null, true);
    wp_enqueue_script('events/js', asset_path('scripts/events.js'), [], null, true);
    wp_enqueue_script('stories/js', asset_path('scripts/stories.js'), [], null, true);
    wp_enqueue_script('workshops/js', asset_path('scripts/workshops.js'), [], null, true);
    // External fonts
    wp_enqueue_style('fonts/css', 'https://fast.fonts.net/cssapi/dae2ada1-fb62-4216-ab20-8072b137a586.css', false, null);
    wp_enqueue_style('google/fonts/css', 'https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700', false, null);
    // OWL Carousel (used for Events timeline)
    wp_enqueue_style('owl.carousel.main', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css', false, null);
    wp_enqueue_style('owl.carousel.theme', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.theme.min.css', false, null);
    wp_enqueue_style('owl.carousel.transitions', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.transitions.min.css', false, null);
    wp_enqueue_script('owl_carousel', 'https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.js', [], null, true);
}, 100);

/**
 * Theme setup
 */
add_action('after_setup_theme', function () {
    /**
     * Enable features from Soil when plugin is activated
     * @link https://roots.io/plugins/soil/
     */
    add_theme_support('soil-clean-up');
    add_theme_support('soil-jquery-cdn');
    add_theme_support('soil-nice-search');
    add_theme_support('soil-relative-urls');
    add_theme_support('soil-js-to-footer');
    add_theme_support('soil-disable-trackbacks');
    add_theme_support('soil-disable-asset-versioning');
    add_theme_support('soil-google-analytics', get_google_analytics_id());

    /**
     * Enable plugins to manage the document title
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnails
     * @link http://codex.wordpress.org/Post_Thumbnails
     * @link http://codex.wordpress.org/Function_Reference/set_post_thumbnail_size
     * @link http://codex.wordpress.org/Function_Reference/add_image_size
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable post formats
     * @link http://codex.wordpress.org/Post_Formats
     */
     add_theme_support('post-formats', ['video', 'audio']);

    /**
     * Enable HTML5 markup support
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5
     */
    add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

    /**
     * Register navigation menus
     * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
    register_nav_menus([
        'modal_navigation'     => __('Modal menu', 'rebe'),
        'primary_navigation'   => __('Primary Navigation', 'rebe'),
        'optional_navigation'  => __('Optional Navigation', 'rebe'),
        'directory_section_1'  => __('Footer Directory 1', 'rebe'),
        'directory_section_2'  => __('Footer Directory 2', 'rebe'),
        'directory_section_3'  => __('Footer Directory 3', 'rebe'),
        'directory_section_4'  => __('Footer Directory 4', 'rebe')
    ]);

    /**
     * Cleaner walker wp_nav_menu()
     * Adds custom classes to navigation menus
     * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
     */
    new NavWalker([
        'menu_item_class'     => 'c-menu__item',
        'active_class'        => 'is-active',
        'menu_sub_item_class' => 'c-menu__subitem',
        'dropdown_class'      => 'c-menu__dropdown'
    ]);
});

/**
 * Theme options
 */
add_action('after_setup_theme', function () {

    /**
    * Generated image sizes
    * @link https://developer.wordpress.org/reference/functions/add_image_size/
    */
    // Thumnail image size for admin use
    update_option('thumbnail_size_w', 250);
    update_option('thumbnail_size_h', 250);
    // Medium image size
    update_option('medium_size_w', 800);
    update_option('medium_size_h', 9999);
    // Large image size
    update_option('large_size_w', 1200);
    update_option('large_size_h', 9999);

    /**
    * Set permalink structure to use pretty post namespace
    * @link https://codex.wordpress.org/Using_Permalinks
    */
    update_option('permalink_structure', '/%postname%/');

    /**
    * Disable year/month uploads folders
    */
    update_option('uploads_use_yearmonth_folders', false);

    /**
    * Set the default comment status to 'closed'
    */
    update_option('default_comment_status', 'closed');
});

/**
 * Theme custom posts and taxonomies
 *
 * @example Basic post type: `$book = new PostType('book_post', 'Book', [<arguments>]);`
 * @example Special post name: `$movie = new PostType('movie_post', '['Фильм', 'Фильмы']', [<arguments>]);`
 * @example Basic taxonomy: `$book->add_taxonomy('book_author', 'Author', [<arguments>]);`
 * @example Special taxonomy name: `$movie->add_taxonomy('film_director', ['Режисер', 'Режисеры']', [<arguments>]);`
 * @example Multiple post taxonomy: `new Taxonomy('shared_tag', 'Tag', ['book_post', 'movie_post'], [<arguments>]);`
 *
*/
add_action('init', function() {

    /* Event */
    $event = new PostType(
        'event',
        'Event',
        [
            'rewrite'       => ['slug' => get_field('event_post_type_slug', 'option') . '/%event_timeline%'],
            'supports'      => ['title', 'thumbnail'],
            'menu_position' => 6,
            'menu_icon'     => 'dashicons-backup',
        ]
    );

    $event->add_taxonomy(
        'event_timeline',
        'Timeline',
        [
            'hierarchical'      => true,
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
            'sort'              => true
        ]
    );

    $event->add_taxonomy(
        'event_era',
        'Era',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
        ]
    );

    $event->add_taxonomy(
        'event_type',
        'Type',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
        ]
    );

    $event->add_taxonomy(
        'event_topic',
        'Topic',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'sort'              => true
        ]
    );

    $event->add_taxonomy(
        'event_group',
        'Group',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'sort'              => true
        ]
    );

    /* Story */
    $story = new PostType(
        'story',
        'Story',
        [
            'rewrite'       => ['slug' => get_field('story_post_type_slug', 'option')],
            'supports'      => ['title', 'thumbnail', 'post-formats'],
            'menu_position' => 6,
            'menu_icon'     => 'dashicons-format-status'
        ]
    );

    $story->add_taxonomy(
        'story_topic',
        'Topic',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
        ]
    );

    $story->add_taxonomy(
        'story_city',
        'City',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
        ]
    );

    $story->add_taxonomy(
        'story_person',
        'Person',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    $story->add_taxonomy(
        'story_group',
        'Group',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    $story->add_taxonomy(
        'story_group',
        'Group',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    /* Workshop */
    $workshop = new PostType(
        'workshop',
        'Workshop',
        [
            'rewrite'       => ['slug' => get_field('workshop_post_type_slug', 'option')],
            'supports'      => ['title', 'thumbnail'],
            'menu_position' => 6,
            'menu_icon'     => 'dashicons-universal-access-alt'
        ]
    );

    $workshop->add_taxonomy(
        'workshop_location',
        'Location',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    $workshop->add_taxonomy(
        'workshop_language',
        'Language',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    $workshop->add_taxonomy(
        'workshop_type',
        'Type',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    $workshop->add_taxonomy(
        'workshop_topic',
        'Topic',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
        ]
    );

    $workshop->add_taxonomy(
        'workshop_group',
        'Group',
        [
            'public'            => false,
            'show_in_nav_menus' => false,
            'meta_box_cb'       => false,
            'show_admin_column' => true,
        ]
    );

    /*
    * Tag taxonomy
    * Shared between 'Event', 'Story' and 'Wokshop' post types
    */
    new Taxonomy(
        'global_tag',
        'Tag',
        ['event', 'story', 'workshop'],
        [
            'public'                => false,
            'show_in_nav_menus'     => false,
            'meta_box_cb'           => false,
            'sort'                  => true,
            'update_count_callback' => '_update_post_term_count',
        ]
    );

});

/**
 * Flush rewrite rules after switching to our theme
 */
add_action('after_switch_theme', 'flush_rewrite_rules' );
