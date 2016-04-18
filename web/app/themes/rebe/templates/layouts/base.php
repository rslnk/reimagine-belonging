<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('components/head'); ?>
  <body>
      <?php App\get_facebook_sdk(); ?>
      <?php
        do_action('get_header');
        get_template_part('components/header');
      ?>
      <?php include App\template_unwrap(); ?>
      <?php
        get_template_part('components/footer');
        wp_footer();
      ?>
  </body>
</html>
