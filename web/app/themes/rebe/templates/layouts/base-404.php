<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('components/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if lt IE 9]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'rebe'); ?>
      </div>
    <![endif]-->
    <?php include App\template_unwrap(); ?>
    <?php wp_footer(); ?>
  </body>
</html>
