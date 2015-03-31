<?php
/*
Basic WordPress setup

Set uploads path to /media;
Set uploads URL path to example.com/media;
Set permalink structure to post name

Based on Roots.io wp-setup.php file
https://gist.github.com/swalkinshaw/6400708

*/

if (!is_blog_installed()) { return; }

if ('http://' . $_SERVER['SERVER_NAME'] . '/wp' == get_option('siteurl')) {
  update_option('upload_path', $_SERVER['DOCUMENT_ROOT'] . '/media');
  update_option('upload_url_path', 'http://' . $_SERVER['SERVER_NAME'] . '/media');
  update_option('uploads_use_yearmonth_folders', false);
  update_option('permalink_structure', '/%postname%/');
}