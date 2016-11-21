<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

/**
 * Require Composer autoloader if installed on it's own
 */
if (file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    require_once $composer;
}

/**
 * Here's what's happening with these hooks:
 * 1. WordPress detects theme in themes/rebe
 * 2. When we activate, we tell WordPress that the theme is actually in themes/rebe/templates
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/rebe
 *
 * We do this so that the Template Hierarchy will look in themes/rebe/templates for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage
 *
 * get_template_directory()   -> /srv/www/reimaginebelonging.org/current/web/app/themes/rebe
 * get_stylesheet_directory() -> /srv/www/reimaginebelonging.org/current/web/app/themes/rebe
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/reimaginebelonging.org/current/web/app/themes/rebe
 * └── TEMPLATEPATH           -> /srv/www/reimaginebelonging.org/current/web/app/themes/rebe/templates
 */
add_filter('template', function ($stylesheet) {
    return dirname($stylesheet);
});
add_action('after_switch_theme', function () {
    $stylesheet = get_option('template');
    if (basename($stylesheet) !== 'dist/templates') {
        update_option('template', $stylesheet . '/dist/templates');
    }
    echo $stylesheet;
});

/**
 * Theme includes
 *
 * The $theme_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 */
$theme_includes = [
    'src/helpers.php',
    'src/setup.php',
    'src/filters.php',
    'src/admin.php',
    'src/api.php'
];
array_walk($theme_includes, function ($file) {
    if (!locate_template($file, true, true)) {
        trigger_error(sprintf(__('Error locating %s for inclusion', 'rebe'), $file), E_USER_ERROR);
    }
});
