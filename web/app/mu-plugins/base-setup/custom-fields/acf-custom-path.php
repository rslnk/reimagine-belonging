<?php

/*

  # ACF PRO custom fields path

  Set custom save/load path to JSON custom fields
  http://www.advancedcustomfields.com/resources/local-json/

*/

add_filter('acf/settings/save_json', 'custom_acf_json_save_point');
add_filter('acf/settings/load_json', 'custom_acf_json_load_point');

function custom_acf_json_save_point( $path ) {
  // update path
  $path = __DIR__;
  // return
  return $path;
  /* echo $path; */
}
function custom_acf_json_load_point( $paths ) {
  // remove original path (optional)
  unset($paths[0]);
  // append path
  $paths[] = __DIR__;
  // return
  return $paths;
}
