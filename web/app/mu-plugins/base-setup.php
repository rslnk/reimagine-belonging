<?php
/*
  Plugin Name:  Base Setup
  Description:  Automatically sets site specific defaults: * Sets upload path to /media; * Sets upload path URL to example.com/media; * Disables year/month folder structure for uploads; * Sets permalink structure to post name; * Sets save/load path to ACF PRO JSON custom fileds;
  Version:      1.0.0
  Author:       Ruslan Komjakov
  Author URI:   https://github.com/rslnk
*/

if (!is_blog_installed()) { return; }

/*
  WordPress Setup

  Set uploads path to /media;
  Set uploads URL path to example.com/media;
  Set permalink structure to post name

  Based on Roots.io wp-setup.php file
  https://gist.github.com/swalkinshaw/6400708
 */

if ('http://' . $_SERVER['SERVER_NAME'] . '/wp' == get_option('siteurl')) {
  update_option('upload_path', $_SERVER['DOCUMENT_ROOT'] . '/media');
  update_option('upload_url_path', 'http://' . $_SERVER['SERVER_NAME'] . '/media');
  update_option('uploads_use_yearmonth_folders', false);
  update_option('permalink_structure', '/%postname%/');
}