<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <?php wp_head(); ?>
    <?php if (is_page_template('template-timeline.php') || is_page_template('template-stories.php')) {
      $parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
      $base = $parts[1];
      ?>
      <base href="/<?php echo $base; ?>/"></base>
    <?php } ?>
    <?php get_template_part('templates/head', 'meta'); ?>
  </head>
