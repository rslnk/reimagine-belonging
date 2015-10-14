<?php
/*
  Plugin Name:  Base Setup
  Description:  Automatically sets site specific defaults.
  Version:      1.0.0
  Author:       Ruslan Komjakov
  Author URI:   https://github.com/rslnk

  - Sets upload path to /media;
  - Sets upload path URL to example.com/media
  - Disables year/month folder structure for uploads
  - Creates API endpoint, calls and data to be used by Angular apps Events and Stories
  - Redirect URL request for Angular Events and Stories apps if user-agent is not a bot
  - Add Angular apps <base> to HTML <head> if Events and Stories templates are called
  - Sets save/load path to ACF PRO JSON custom fileds
  - Sets permalink structure to post name

*/

if (!is_blog_installed()) { return; }

// Base Setup files
require_once('media-uploads.php');
require_once('api/api.php');
require_once('redirects/ng-apps-base.php');
require_once('redirects/ng-apps-redirects.php');
require_once('redirects/permalink-structure.php');
require_once('redirects/is-bot.php');
require_once('custom-fields/acf-custom-path.php');
