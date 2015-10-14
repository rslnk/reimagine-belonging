<?php

use BaseSetup\API\Data;
use BaseSetup\Redirects\UserAgentCheck;
use Theme\Lib\PostTypes;

/*

  # Redirects for Events and Stories Angular apps

  - We are catching all Events and Stories posts requests
  - Checking slugs for Events and Stories post to use them as requests endpoints
  - If user-agent is not a bot or a crowler substitute permalink within Angular apps internal urls
  - If user-agent is bot or crowler redirect to actual post permalink to scrap data from the standard WP template

 */


// Events app redirect
add_action('parse_request', 'create_events_proxy', 2);

function create_events_proxy () {
  global $wp;

  /*

    Events post type URL structure

    reimaginebelonging.org/<events_slug_base>/<events_slug>/

    - events_slug       — set from WP admin
    - events_slug_base  — set from WP admin (optional)

    If user-agent is not a bot or crawler check timeline taxonomy terms
    and append the first one to the URL:

    reimaginebelonging.org/history/events/united-states

  */

  $events_slug      = get_field('event_post_type_slug', 'option');
  $events_slug_base = get_field('event_post_type_slug_base', 'option');
  $events_full_slug = PostTypes\GetEventPostTypeSlug();

  $url = $_SERVER["REQUEST_URI"];
  if(substr($url, -1) == '/') {
    $url = substr($url, 0, -1);
  }
  $parts = explode('/', rtrim($url, '/'));

  $timelines = get_terms( 'event_timeline' );
  $get_event_timelines = array();

  foreach($timelines as $timeline) {
    $v = (array) $timeline;
    array_push($get_event_timelines, $v['slug']);
  }

  // Check if events_slug_base is set:
  if (!empty(get_field('event_post_type_slug_base'))) {

    $base = "/$events_slug_base/i";

    if (preg_match($base, $wp->request)) {

      if (!UserAgentCheck\is_bot()) {
        if (count($parts) > 2) {
          setcookie("events", $url, time()+3600, "/");
          header('Location: /' . $events_slug_base . '/');
          exit;
        }
      }

      else {

        if (count($parts) > 2 && in_array($parts[2], $get_event_timelines)) {
          header('Location: /' . $events_full_slug  . '/'. $parts[3]);
          exit;
        }
      }
    }
  }
  // If events_slug_base is not set just use events_slug:
  else {
    $base = "/$events_slug/i";

    if (preg_match($base, $wp->request)) {

      if (!UserAgentCheck\is_bot()) {
        if (count($parts) > 2) {
          setcookie("events", $url, time()+3600, "/");
          header('Location: /' . $events_slug .'/');
          exit;
        }
      }

      else {
        if (count($parts) > 2 && in_array($parts[2], $get_event_timelines)) {
          header('Location: /' . $events_slug . '/'. $parts[3]);
          exit;
        }
      }
    }
  }
}


// Stories app redirect
add_action('parse_request', 'create_stories_proxy', 1);

function create_stories_proxy () {
  global $wp;

  $stories_slug  = get_field('story_post_type_slug', 'option');
  $base          = "/$stories_slug/i";

  if (preg_match($base, $wp->request)) {
    if (!UserAgentCheck\is_bot()){
      $url = $_SERVER["REQUEST_URI"];
      if(substr($url, -1) == '/') {
        $url = substr($url, 0, -1);
      }      
      $parts = explode('/', rtrim($url, '/'));
      if (count($parts) > 2) {
        setcookie("stories", $url, time()+3600, "/");
        header('Location: /' . $stories_slug . '/');
        exit;
      }
    }
  }
}
