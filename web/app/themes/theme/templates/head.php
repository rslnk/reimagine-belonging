<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="alternate" type="application/rss+xml" title="<?= get_bloginfo('name'); ?> Feed" href="<?= esc_url(get_feed_link()); ?>">
    <?php wp_head(); ?>
    <?php if (is_page_template('template-timeline.php') || is_page_template('template-stories.php')) { 
      $parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
      $base = $parts[1];
      ?>
      <base href="/<?php echo $base; ?>/"></base>
    <?php } ?>
  </head>
