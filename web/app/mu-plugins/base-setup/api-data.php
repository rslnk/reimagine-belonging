<?php
/*
* Sample code for using WordPress as a REST API endpoint (vs AJAX Admin)
* Author: Pete Nelson @GunGeekATX
*
* 1) Create a page called API in WordPres
* 2) Create a file called page-api.php in your theme directory
* 3) Add code as-needed
*
*/


// See what API call we want to do
// example: http://localhost:/wp-mysite/api/?action=list-all-pages

$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';

$output = null;
$sample_api = new My_Sample_API();

switch ($action) {
  case 'list-all-pages':
    $output = $sample_api->list_all_pages();
    break;

  default:
    $output = array('error' => 'invalid action');
    break;
}

if ($output) {
  // callback support for JSONP
  if (isset($_REQUEST["callback"])) {
    header("Content-Type: application/javascript");
    echo $_REQUEST['callback'] . '(' . json_encode($output) . ')';
  }
  else {
    header("Content-Type: application/json");
    echo json_encode($output);
  }
}

die();



class My_Sample_API {

  function list_all_pages() {

    // last three options are from
    // http://www.billerickson.net/code/improve-performance-of-wp_query/

    $query = new WP_Query(
      array(
        'post_type' => 'page',
        'no_found_rows' => true, // counts posts, remove if pagination required
        'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
        'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
      )
    );

    $output = array();

    // output just a small subset of the page information
    while ($query->have_posts()) {
      $p= $query->next_post();

      // we'll return just a subest of
      $output[] = array(
        'id' => $p->ID,
        'title' => $p->post_title,
        'post_date_gmt' => $p->post_date_gmt,
        'permalink' => get_permalink( $p->ID ),
      );

    }

    return $output;

  }

}