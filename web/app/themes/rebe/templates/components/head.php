<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
   // Sets base URL path for Events and Stories Angular apps
    if (is_page_template('template-timeline.php') || is_page_template('template-stories.php')) {
        App\set_template_uri_base();
    }
  ?>
  <?php
  // Show video meta tags if post type is 'story' and post format is video
   if (is_singular('story') && has_post_format('video', $post->ID)) {
       get_template_part('templates/meta', 'video');
   }
  ?>
  <?php wp_head(); ?>
  <?php //BaseSetup\Redirects\AngularAppBase\Path(); ?>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/dist/images/meta/favicon-32.png" type="image/x-icon">
</head>
