<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('components/head'); ?>
  <body class="c-home js-home">
    <div class="has-background js-background-image">
      <?php
        do_action('get_header');
        get_template_part('components/header');
      ?>
      <?php include App\template_unwrap(); ?>
    </div>
    <?php
      get_template_part('components/footer');
      wp_footer();
    ?>
  </body>
</html>
