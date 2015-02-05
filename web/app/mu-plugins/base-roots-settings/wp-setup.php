<?php
/*
Sets WordPress settings on theme activation

Based on Roots.io wp-setup.php file
https://gist.github.com/swalkinshaw/6400708

* Updates site url to www.sitename.com/wp;
* Updates home url to www.sitename.com;
* Updates permalink structure;

* Sets respective blog and post pages for homepage and blog;

In case upload path is emty (as by defualt):
  * Sets uploads directory to 'web/media';
  * Sets uploads directory URL to sitename.com/media;
  * Disables uploads sorting by year/month folders;
*/

if (!is_blog_installed()) { return; }

if ('http://' . $_SERVER['SERVER_NAME'] . '/wp' == get_option('home')) {
  update_option('siteurl', 'http://' . $_SERVER['SERVER_NAME'] . '/wp');
  update_option('home', 'http://' . $_SERVER['SERVER_NAME']);
  update_option('permalink_structure', '/%postname%/');
}

if (defined('FRONT_PAGE') && defined('POSTS_PAGE') && !get_option('page_on_front')) {
  $front = get_page_by_title(FRONT_PAGE);
  $posts = get_page_by_title(POSTS_PAGE);

  if ($front && $posts) {
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front->ID);
    update_option('page_for_posts', $posts->ID);
  }
}

if ( empty( $upload_path ) || 'wp-content/uploads' == $upload_path ) {
  update_option('upload_path', $_SERVER['DOCUMENT_ROOT'] . '/media');
  update_option('upload_url_path', 'http://' . $_SERVER['SERVER_NAME'] . '/media');
  update_option('uploads_use_yearmonth_folders', false);
}