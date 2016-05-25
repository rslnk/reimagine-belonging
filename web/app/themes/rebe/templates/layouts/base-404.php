<!DOCTYPE html><html <? language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (is_page_template('templates/template-events.php') || is_page_template('templates/template-stories.php') || is_page_template('templates/template-workshops.php')) : ?>
  <?php App\set_template_uri_base(); ?>
  <?php endif; ?>
  <?php wp_head(); ?>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/dist/images/meta/favicon-32.png" type="image/x-icon">
</head>
<body class="c-404 js-404">
  <?php include App\template_unwrap(); ?>
  <?php wp_footer(); ?>
</body></html>