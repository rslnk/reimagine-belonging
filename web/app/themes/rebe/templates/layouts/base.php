<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('components/head'); ?>
  <body <?php body_class(); ?>>
    <div class="<?php if(is_front_page()) echo 'c-home__image'; ?>">
      <?php App\get_facebook_sdk(); ?>
      <?php
        do_action('get_header');
        // Get header depending on the template
        if(is_front_page()): get_template_part('components/header-home'); else: get_template_part('components/header-default'); endif;
      ?>
      <?php include App\template_unwrap(); ?>
      <?php
        get_template_part('components/footer');
        wp_footer();
      ?>
    </div>

  </body>
</html>
