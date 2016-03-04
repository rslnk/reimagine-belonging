<?php namespace App;

use Roots\Sage\Template;
use Roots\Sage\Template\Wrapper;

/**
 * Set save point for ACF Pro custom field groups JSON files
 * @link http://www.advancedcustomfields.com/resources/local-json/
 */
add_filter('acf/settings/save_json', function ($path) {
  $path = get_stylesheet_directory() . '/src/lib/ReBe/Fields';
  return $path;
});

/**
 * Set load point for ACF Pro custom field groups JSON files
 * @link http://www.advancedcustomfields.com/resources/local-json/
 */
add_filter('acf/settings/load_json', function ($paths) {
  unset($paths[0]);
  $paths[] = get_stylesheet_directory() . '/src/lib/ReBe/Fields';
  return $paths;
});

/**
 * Set 'Story' post type default format to 'video'
 */
add_filter('option_default_post_format', function ($format) {
    global $post_type;
    return ($post_type == 'story' ? 'video' : $format);
}, 10, 1);

/**
 * Determine which pages should NOT display the sidebar
 * @link https://codex.wordpress.org/Conditional_Tags
 */
add_filter('sage/display_sidebar', function ($display) {
    // The sidebar will NOT be displayed if ANY of the following return true
    return $display ? !in_array(true, [
        is_404(),
        is_front_page(),
        is_page_template('template-custom.php'),
    ]) : $display;
});

/**
 * Add <body> classes
 */
add_filter('body_class', function (array $classes) {
    // Add page slug if it doesn't exist
    if (is_single() || is_page() && !is_front_page()) {
        if (!in_array(basename(get_permalink()), $classes)) {
            $classes[] = basename(get_permalink());
        }
    }

    // Add class if sidebar is active
    if (display_sidebar()) {
        $classes[] = 'sidebar-primary';
    }

    return $classes;
});

/**
 * Add "… Continued" to the excerpt
 */
add_filter('excerpt_more', function () {
    return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'rebe') . '</a>';
});

/**
 * Use theme wrapper
 */
add_filter('template_include', function ($main) {
    if (!is_string($main) || !(string) $main) {
        return $main;
    }
    return template_wrap(new Wrapper(basename($main)));
}, 109);
