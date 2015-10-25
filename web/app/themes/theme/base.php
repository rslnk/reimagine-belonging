<?php

use Roots\Sage\Extras;
use Roots\Sage\Wrapper;

?>

<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('templates/head'); ?>
  <body <?php body_class(); ?>>
    <?php
      // Add extra classes and styles to the site wrapper on the homepage
      $home_wrapper_classes = 'u-image-container c-home__image';
      $home_wrapper_syle    = 'style="background-image: url(' . get_template_directory_uri()  . '/dist/images/homepage-intro-image--1.1.jpg);"';
    ?>
    <div class="o-site-wrapper <?php if(is_front_page()) echo $home_wrapper_classes ?>" <?php if(is_front_page()) echo $home_wrapper_syle ?>>
      <!--[if lt IE 9]>
        <div class="alert alert-warning">
          <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'sage'); ?>
        </div>
      <![endif]-->
      <?php Extras\facebook_sdk(); ?>
      <?php
        do_action('get_header');
        // Get header depending on the template
        if(is_front_page()): get_template_part('templates/header', 'home'); else: get_template_part('templates/header', 'default'); endif;
      ?>
      <?php include Wrapper\template_path(); ?>
    </div>
    <?php
      get_template_part('templates/footer');
      wp_footer();
    ?>
  </body>
</html>
