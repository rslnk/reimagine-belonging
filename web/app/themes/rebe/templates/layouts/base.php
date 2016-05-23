<!DOCTYPE html><html <? language_attributes(); ?>>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php if (is_page_template('templates/template-events.php') || is_page_template('templates/template-stories.php')) : ?>
  <?php App\set_template_uri_base(); ?>
  <?php endif; ?>
  <?php wp_head(); ?>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/dist/images/meta/favicon-32.png" type="image/x-icon">
</head>
<body>
  <?php App\get_facebook_sdk(); ?>
  <?php if (is_front_page()) { $modifier = '--home'; } else { $modifier = null; } ; ?>
  <header class="c-header<? echo $modifier ?> js-header">
    <nav class="c-header__menu"><a href="<?= esc_url(home_url('/')); ?>">
        <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 530 50" class="c-header__logo<? echo $modifier; ?>">
          <path d="M68.8 50L68.8 50c-1.2 0-2.1-1-2.1-2.1V2.1c0-1.2 1-2.1 2.1-2.1h0c1.2 0 2.1 1 2.1 2.1v45.7C70.9 49 70 50 68.8 50zM193.1 47.9V2.1c0-1.2-1-2.1-2.1-2.1l0 0c-1.2 0-2.1 1-2.1 2.1v45.7c0 1.2 1 2.1 2.1 2.1l0 0C192.1 50 193.1 49 193.1 47.9zM53 45.7l-15.6 0V27.1l11.3 0c1.2 0 2.1-1 2.1-2.1 0-1.2-1-2.1-2.1-2.1H37.4V4.3l15.6 0c1.2 0 2.1-1 2.1-2.1 0-1.2-1-2.1-2.1-2.1H35.2c-0.4 0-0.8 0.1-1.1 0.3 -0.5 0.3-0.8 0.7-1 1.3 0 0.2-0.1 0.3-0.1 0.5v45.7c0 1.2 1 2.1 2.1 2.1L53 50c1.2 0 2.1-1 2.1-2.1C55.1 46.7 54.1 45.7 53 45.7zM325 47.5h-15.9V26.2h10.8c0.7 0 1.2-0.6 1.2-1.2 0-0.7-0.6-1.2-1.2-1.2h-10.8V2.5l15.9 0c0.7 0 1.2-0.6 1.2-1.2 0-0.7-0.6-1.2-1.2-1.2h-17.2c-0.7 0-1.2 0.6-1.2 1.2v47.5c0 0.7 0.6 1.2 1.2 1.2H325c0.7 0 1.2-0.6 1.2-1.2C326.3 48 325.7 47.5 325 47.5zM356.2 47.5h-15.9V1.2c0-0.7-0.6-1.2-1.2-1.2 -0.7 0-1.2 0.6-1.2 1.2v47.5c0 0.7 0.6 1.2 1.2 1.2h17.2c0.7 0 1.2-0.6 1.2-1.2C357.4 48 356.9 47.5 356.2 47.5zM461.8 0c-0.7 0-1.2 0.6-1.2 1.2v47.5c0 0.7 0.6 1.2 1.2 1.2 0.7 0 1.2-0.6 1.2-1.2V1.2C463.1 0.6 462.5 0 461.8 0zM263 45.7l-15.6 0V27.1l11.3 0c1.2 0 2.1-1 2.1-2.1 0-1.2-1-2.1-2.1-2.1h-11.3V4.3l15.6 0c1.2 0 2.1-1 2.1-2.1 0-1.2-1-2.1-2.1-2.1h-17.7c-0.4 0-0.8 0.1-1.1 0.3 -0.5 0.3-0.8 0.7-1 1.3 0 0.2-0.1 0.3-0.1 0.5v45.7c0 1.2 1 2.1 2.1 2.1l17.7 0c1.2 0 2.1-1 2.1-2.1C265.1 46.7 264.1 45.7 263 45.7zM166.1 25c-1.2 0-2.1 1-2.1 2.1 0 1.2 1 2.1 2.1 2.1h5.3v10c0 3.6-2.9 6.5-6.5 6.5 -3.6 0-6.5-2.9-6.5-6.5V10.8c0-3.6 2.9-6.5 6.5-6.5 3.6 0 6.5 2.9 6.5 6.5l0 1.3c0 1.2 1 2.1 2.1 2.1 1.2 0 2.1-1 2.1-2.1l0-1.3c0-6-4.8-10.8-10.8-10.8 -6 0-10.8 4.8-10.8 10.8v28.4c0 6 4.8 10.8 10.8 10.8 6 0 10.8-4.8 10.8-10.8v-10V25h-4.3H166.1zM384.4 10.8v28.4c0 6-4.8 10.8-10.8 10.8s-10.8-4.8-10.8-10.8V10.8c0-6 4.8-10.8 10.8-10.8S384.4 4.8 384.4 10.8zM381.9 10.8c0-4.6-3.7-8.3-8.3-8.3 -4.6 0-8.3 3.7-8.3 8.3v28.5c0 4.6 3.7 8.3 8.3 8.3 4.6 0 8.3-3.7 8.3-8.3V10.8zM416.4 1.2c0-0.7-0.6-1.2-1.2-1.2 -0.7 0-1.2 0.6-1.2 1.2v41.2L396.7 0.9c-0.1-0.5-0.6-1-1.2-1h0c-0.7 0-1.2 0.6-1.2 1.2v47.5c0 0.7 0.6 1.2 1.2 1.2h0c0.7 0 1.2-0.6 1.2-1.2V7.6L414 49.2c0 0 0 0 0 0 0 0 0 0.1 0.1 0.1 0.1 0.1 0.2 0.3 0.3 0.4 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0.1 0.3 0.2 0.5 0.2 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0 0 0 0 0 0 0 0.2 0 0.4-0.1 0.6-0.3 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2-0.2 0.3-0.5 0.3-0.8 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0V1.2zM446.5 10.7l0 0.3c0 0.7 0.6 1.2 1.2 1.2h0c0.7 0 1.2-0.6 1.2-1.2l0-0.3c0-0.7-0.6-1.2-1.2-1.2l0 0C447.1 9.4 446.5 10 446.5 10.7zM439.4 25c-0.7 0-1.2 0.6-1.2 1.2 0 0.7 0.6 1.2 1.2 1.2h7.1v11.8c0 4.6-3.7 8.3-8.3 8.3 -4.6 0-8.3-3.7-8.3-8.3V10.8c0-4.6 3.7-8.3 8.3-8.3 4.6 0 8.3 3.7 8.3 8.3l2.5 0c0-6-4.8-10.8-10.8-10.8 -6 0-10.8 4.8-10.8 10.8v28.4c0 6 4.8 10.8 10.8 10.8 6 0 10.8-4.8 10.8-10.8V27.5 25h-2.5H439.4zM143.4 49.9c-1.2 0.2-2.3-0.5-2.5-1.7l-2.2-11.1h-9.7l-2.2 11.1c-0.2 1.2-1.4 1.9-2.5 1.7h0c-1.2-0.2-1.9-1.4-1.7-2.5l9.2-45.5c0.1-0.9 0.8-1.7 1.7-1.9h0c0.1 0 0.3 0 0.4 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0 0.3 0 0.4 0 0.9 0.2 1.6 1 1.7 1.9l9.2 45.5C145.3 48.6 144.5 49.7 143.4 49.9zM137.8 32.9l-4-19.9 -4 19.9H137.8zM275.7 48.7C275.7 48.7 275.7 48.7 275.7 48.7L275.7 48.7C275.7 48.7 275.7 48.7 275.7 48.7zM276.9 50L276.9 50c-0.1 0-0.2 0-0.3 0C276.7 50 276.8 50 276.9 50zM496.8 1.2c0-0.7-0.6-1.2-1.2-1.2 -0.7 0-1.2 0.6-1.2 1.2v41.2L477.1 0.9c-0.1-0.5-0.6-1-1.2-1 -0.7 0-1.2 0.6-1.2 1.2v47.5c0 0.7 0.6 1.2 1.2 1.2 0.7 0 1.2-0.6 1.2-1.2V7.6l17.2 41.6c0 0 0 0 0 0 0 0 0 0.1 0.1 0.1 0.1 0.1 0.2 0.3 0.3 0.4 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0.1 0.3 0.2 0.5 0.2 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0 0 0 0 0 0 0 0.2 0 0.4-0.1 0.6-0.3 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2-0.2 0.3-0.5 0.3-0.8 0 0 0 0 0 0 0 0 0 0 0 0V1.2zM530 10.6C529.9 4.7 525.1 0 519.2 0c-6 0-10.8 4.8-10.8 10.8v28.4c0 6 4.8 10.8 10.8 10.8 6 0 10.8-4.8 10.8-10.8V27.5 25h-2.5 -7.1c-0.7 0-1.2 0.6-1.2 1.2 0 0.7 0.6 1.2 1.2 1.2h7.1v11.8c0 4.6-3.7 8.3-8.3 8.3s-8.3-3.7-8.3-8.3V10.8c0-4.6 3.7-8.3 8.3-8.3 4.6 0 8.3 3.7 8.3 8.3V11c0 0.7 0.6 1.2 1.2 1.2 0.7 0 1.2-0.6 1.2-1.2L530 10.6C530 10.7 530 10.7 530 10.6zM297.1 36.8c0 1.7-0.3 3.2-0.8 4.8 -0.5 1.5-1.2 3-2.1 4.2l-0.2 0.2c-0.8 1.2-2.8 4-7.1 4h-10.1v0c-0.7 0-1.2-0.6-1.2-1.2V1.2c0-0.7 0.6-1.2 1.2-1.2 0 0 0 0 0.1 0h8.8c4.1 0 6 2.9 6.7 4l0.1 0.1c0.8 1.2 1.3 2.6 1.8 4.1 0.4 1.5 0.6 3.2 0.6 4.9 0 1.7-0.2 3.2-0.7 4.7 -0.4 1.5-1 2.9-1.8 4.1 0 0-1 1.7-2 2.5 2 0.9 3.8 3.3 3.8 3.3 0.9 1.2 1.6 2.6 2.1 4.2C296.8 33.4 297.1 35.1 297.1 36.8zM278.2 23.7h7.6c2.8 0 3.9-2.2 4.6-3.2 0.6-1 1.1-2.2 1.5-3.5 0.4-1.3 0.5-2.6 0.6-4 0-1.5-0.2-2.9-0.5-4.2 -0.4-1.3-0.9-2.5-1.5-3.5 -0.6-1-1.8-2.9-4.6-2.9h-7.6V23.7zM294.6 36.8c0-1.5-0.2-2.9-0.6-4.2 -0.4-1.3-1-2.5-1.7-3.5 -0.7-1-2-2.9-5.3-2.9h-8.8v21.3h8.8c3.3 0 4.5-2.2 5.3-3.2 0.7-1 1.3-2.2 1.7-3.5C294.3 39.5 294.5 38.2 294.6 36.8zM111.4 2.1C111.4 2.1 111.4 2.1 111.4 2.1c0-0.1 0-0.1 0-0.1 0 0 0 0 0 0 -0.1-1-0.8-1.8-1.8-2 0 0 0 0 0 0 0 0-0.1 0-0.1 0 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0-0.1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0-0.1 0 0 0 0 0 0 0 -0.4 0-0.7 0.2-1 0.4 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0 0 0 0 0 0 0 0 0 -0.2 0.2-0.4 0.4-0.6 0.6 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.1 0 0 0 0 0 0 0 0 0 0.1 0 0.1 0 0 0 0 0 0L97.6 23 87.9 1.3c0 0 0 0 0 0 0 0 0-0.1 0-0.1 0 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0 0 0 0 0 0 0 0 -0.1-0.3-0.3-0.5-0.6-0.6 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0 0 0 -0.3-0.2-0.6-0.3-1-0.4 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0-0.1 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0-0.1 0 0 0 0 0-0.1 0 0 0 0 0 0 0 0 0-0.1 0-0.1 0 0 0 0 0 0 0 -1 0.1-1.8 1-1.8 2 0 0 0 0 0 0 0 0 0 0 0 0.1 0 0 0 0 0 0.1 0 0 0 0 0 0v45.7c0 1.2 1 2.1 2.1 2.1 1.2 0 2.1-1 2.1-2.1V12.2L95.6 29c0.3 0.8 1.2 1.3 2 1.3 0.9 0 1.7-0.5 2-1.3l7.5-16.8v35.7c0 1.2 1 2.1 2.1 2.1 1.2 0 2.1-1 2.1-2.1L111.4 2.1C111.4 2.1 111.4 2.1 111.4 2.1zM228 0c-1.2 0-2.1 1-2.1 2.1v35L210.4 1.4c-0.1-0.2-0.2-0.3-0.3-0.5 -0.4-0.5-1-0.9-1.7-0.9 -1.2 0-2.1 1-2.1 2.1v45.7c0 1.2 1 2.1 2.1 2.1 1.2 0 2.1-1 2.1-2.1V12.6l15.4 35.6c0.2 1 1 1.8 2.1 1.8 1.2 0 2.1-1 2.1-2.1V2.1C230.1 0.9 229.2 0 228 0zM23.3 47l-8-19.1c1.8-1.2 2.8-3 3.3-3.8l0.1-0.2c0.7-1.3 1.3-2.8 1.7-4.4 0.4-1.6 0.6-3.2 0.6-5 0-1.8-0.2-3.5-0.6-5.1 -0.4-1.6-1-3.1-1.7-4.4l-0.1-0.1C17.9 3.7 15.8 0 10.9 0H2.1c0 0 0 0 0 0C1 0 0 0.9 0 2.1v0 45.7 0C0 49 1 50 2.1 50c0 0 0 0 0 0s0 0 0 0c1.2 0 2.1-1 2.1-2.1V29.2h6.9l8.2 19.5c0.5 1.1 1.7 1.6 2.8 1.1C23.2 49.3 23.7 48.1 23.3 47zM13.6 23.9c0 0-0.6 0.6-1.3 0.8 -0.6 0.2-1.3 0.2-1.4 0.2H9.4 4.3V4.3h6.7c2.5 0 3.5 1.9 4 2.8 0.5 1 1 2.1 1.3 3.4 0.3 1.3 0.5 2.6 0.5 4.1 0 1.4-0.2 2.6-0.5 3.9 -0.3 1.3-0.8 2.4-1.3 3.4C14.6 22.4 14.2 23.2 13.6 23.9z"></path>
        </svg>
        <h1 class="u-visually-hidden">
          <?php bloginfo('name'); ?>
        </h1></a><a data-target=".js-modal-menu" class="js-modal-menu-open c-icon-more--circle c-header__menu-icon<? echo $modifier; ?>"><span class="u-visually-hidden">
          <?php the_field('toggle_navigation_button_screen_text', 'option'); ?></span></a>
      <?php if (has_nav_menu('primary_navigation')) : ?>
      <?php wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'c-header__list' . $modifier]); ?>
      <?php endif; ?>
    </nav>
  </header>
  <?php include App\template_unwrap(); ?>
  <footer class="c-footer js-footer">
    <div class="c-footer__content">
      <div class="c-directories">
        <!-- Footer directory section 1-->
        <?php if (has_nav_menu('directory_section_1')) : ?>
        <div class="c-directories__section">
          <?php if (get_field('footer_directory_section_title_1', 'option')) : ?>
          <h4 class="c-directories__title">
            <?php the_field('footer_directory_section_title_1', 'option'); ?>
          </h4>
          <div data-target=".js-directory-list-1" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>
          <?php endif; ?>
          <?php wp_nav_menu(['theme_location' => 'directory_section_1', 'menu_class' => 'c-directories__list js-directory-list-1']); ?>
        </div>
        <?php endif; ?>
        <!-- Footer directory section 2-->
        <?php if (has_nav_menu('directory_section_1')) : ?>
        <div class="c-directories__section">
          <?php if (get_field('footer_directory_section_title_2', 'option')) : ?>
          <h4 class="c-directories__title">
            <?php the_field('footer_directory_section_title_2', 'option'); ?>
          </h4>
          <div data-target=".js-directory-list-2" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>
          <?php endif; ?>
          <?php wp_nav_menu(['theme_location' => 'directory_section_2', 'menu_class' => 'c-directories__list js-directory-list-2']); ?>
        </div>
        <?php endif; ?>
        <!-- Footer directory section 3-->
        <?php if (has_nav_menu('directory_section_3')) : ?>
        <div class="c-directories__section">
          <?php if (get_field('footer_directory_section_title_3', 'option')) : ?>
          <h4 class="c-directories__title">
            <?php the_field('footer_directory_section_title_3', 'option'); ?>
          </h4>
          <div data-target=".js-directory-list-3" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>
          <?php endif; ?>
          <?php wp_nav_menu(['theme_location' => 'directory_section_3', 'menu_class' => 'c-directories__list js-directory-list-3']); ?>
        </div>
        <?php endif; ?>
        <!-- Footer directory section 4-->
        <?php if (has_nav_menu('directory_section_4')) : ?>
        <div class="c-directories__section">
          <?php if (get_field('footer_directory_section_title_4', 'option')) : ?>
          <h4 class="c-directories__title">
            <?php the_field('footer_directory_section_title_4', 'option'); ?>
          </h4>
          <div data-target=".js-directory-list-4" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>
          <?php endif; ?>
          <?php wp_nav_menu(['theme_location' => 'directory_section_4', 'menu_class' => 'c-directories__list js-directory-list-4']); ?>
          <ul class="c-social-links__list">
            <?php if(get_field('facebook_page_url', 'option')) : ?>
            <li class="c-social-links__item"><a href="<?php echo 'https://www.facebook.com/' . get_field('facebook_user_name', 'option'); ?>" class="c-icon-facebook--circle c-social-links__icon"><span class="u-visually-hidden">
                  <?php echo get_field('follow_label', 'option') . ' Facebook'; ?></span></a></li>
            <?php endif; ?>
            <?php if(get_field('twitter_url', 'option')) : ?>
            <li class="c-social-links__item"><a href="<?php echo 'https://www.twitter.com/' . get_field('twitter_user_name', 'option'); ?>" class="c-icon-twitter--circle c-social-links__icon"><span class="u-visually-hidden">
                  <?php echo get_field('follow_label', 'option') . ' Twitter'; ?></span></a></li>
            <?php endif; ?>
            <?php if(get_field('vimeo_url', 'option')) : ?>
            <li class="c-social-links__item"><a href="<?php echo 'https://www.vimeo.com/' . get_field('vimeo_user_name', 'option'); ?>" class="c-icon-vimeo--circle c-social-links__icon"><span class="u-visually-hidden">
                  <?php echo get_field('follow_label', 'option') . ' Vimeo'; ?></span></a></li>
            <?php endif; ?>
          </ul>
        </div>
        <?php endif; ?>
      </div>
      <div class="c-locale">
        <?php if(get_field('site_alternative_locale_url', 'option') && get_field('footer_alternative_locale_button_text', 'option')) : // Get locale; ?><a href="<?php the_field('site_alternative_locale_url', 'option'); ?>" class="c-locale__button"><span class="c-locale__text">
            <?php the_field('footer_alternative_locale_button_text', 'option'); ?></span><span class="c-icon-arrow--circle c-locale__icon"> </span></a>
        <?php endif; ?>
      </div>
      <div class="c-legal">
        <?php if (has_nav_menu('optional_navigation')) : ?>
        <?php wp_nav_menu(['theme_location' => 'optional_navigation', 'menu_class' => 'c-legal__links']); ?>
        <?php endif; ?>
        <?php if (get_field('footer_copyright_notice_part_1', 'option')): ?>
        <div class="c-copyright-notice"><span>
            <?php the_field('footer_copyright_notice_part_1', 'option'); ?></span><span>
            <?php echo date("Y"); ?></span><span>
            <?php the_field('footer_copyright_notice_part_2', 'option'); ?></span></div>
        <?php endif; ?>
      </div>
    </div>
  </footer>
  <div class="c-modal-menu js-modal-menu"><a data-target=".js-modal-menu" class="c-icon-close--circle c-modal-menu__close js-modal-menu-close"></a>
    <nav class="c-modal-menu__content">
      <?php if (has_nav_menu('modal_navigation')) : ?>
      <?php wp_nav_menu(['theme_location' => 'modal_navigation', 'menu_class' => 'c-modal-menu__list']); ?>
      <?php endif; ?>
    </nav>
  </div>
  <?php wp_footer(); ?>
</body></html>