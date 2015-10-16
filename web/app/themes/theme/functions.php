<?php
/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$sage_includes = [
  'lib/admin-cp.php',              // WordPress admin panel modifications
  'lib/assets.php',                // Scripts and stylesheets
  'lib/extras.php',                // Custom functions
  'lib/nav.php',                   // Custom nav modifications
  'lib/post-types.php',            // Custom post types
  'lib/post-taxonomies.php',       // Custom taxonomies
  'lib/setup.php',                 // Theme functions
  'lib/wrapper.php',               // Theme wrapper class
];

foreach ($sage_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);
