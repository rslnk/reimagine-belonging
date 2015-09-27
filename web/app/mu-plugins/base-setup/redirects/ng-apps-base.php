<?php

namespace BaseSetup\Redirects\AngularAppBase;

/*

  # Sets base URL path for Events and Stories Angular apps

  If templates are `template-timeline.php` and `template-stories.php` then enject
  <base> tag with Angular app base path into html <head>.

 */

function Path() {
  if (is_page_template('template-timeline.php') || is_page_template('template-stories.php')) {
   $parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
   echo '<base href="/' . $parts[1] . '/"></base>';
  }
}
