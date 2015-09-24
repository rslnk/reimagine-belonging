<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
    <?php if (is_page_template('template-timeline.php') || is_page_template('template-stories.php')) {
      $parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
      $base = $parts[1];
      ?>
      <base href="/<?php echo $base; ?>/"></base>
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/dist/images/meta/favicon-32.png" type="image/x-icon">
  </head>
