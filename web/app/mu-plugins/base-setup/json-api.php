<?php
// See what API call we want to do
// example: http://localhost:/wp-mysite/api/?action=list-all-pages

class My_Sample_API {

  function list_all_pages() {

    // last three options are from
    // http://www.billerickson.net/code/improve-performance-of-wp_query/

    $query = new WP_Query(
      array(
        'post_type' => 'stories',
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