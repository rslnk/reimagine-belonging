<?php

/*

  # WordPress Uploads and Permalink Setup

  - Set uploads path to /media;
  - Set uploads URL path to example.com/media
  - Disable uploads year/month folders

  Based on Roots.io wp-setup.php: https://gist.github.com/swalkinshaw/6400708

*/

if ('http://' . $_SERVER['SERVER_NAME'] . '/wp' == get_option('siteurl')) {
  update_option('upload_path', $_SERVER['DOCUMENT_ROOT'] . '/media');
  update_option('upload_url_path', 'http://' . $_SERVER['SERVER_NAME'] . '/media');
  update_option('uploads_use_yearmonth_folders', false);
}
