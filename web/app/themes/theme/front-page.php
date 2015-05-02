<main class="o-wrapper--row c-home-intro" style="background-image: url(<? echo get_template_directory_uri() ?>/assets/images/homepage-intro-image--1.0.jpg);">

  <div class="u-centering-wrapper js-main-block">
    <div class="u-centered">
      <div class="o-wrapper">
        <div class="c-home-intro__content">

          <?php if(get_field('homepage_subtitle', 'option')) :?>
            <h2 class="o-heading c-heading--home">
              <?php the_field('homepage_subtitle', 'option') ?>
            </h2>
          <?php endif; ?>
          <h1 class="o-site-logo c-site-logo--home-intro u-icon u-icon-logo-negative">
            <?php the_field('homepage_logo_title', 'option') ?>
          </h1>
          <h1 class="o-site-logo c-site-logo-alt--home-intro u-icon u-icon-logo-alt-negative">
            <?php the_field('homepage_logo_title', 'option') ?>
          </h1>

          <div class="c-home-intro__buttons-wrap">
            <?php if(get_field('homepage_first_button_label', 'option')) :?>
              <a class="o-btn c-btn--large c-btn--mint u-margin--home-intro-button" href="<?php the_field('homepage_first_button_link', 'option') ?>">
                <?php the_field('homepage_first_button_label', 'option') ?>
              </a>
            <?php endif; ?>
            <?php if(get_field('homepage_second_button_label', 'option')) :?>
              <a class="o-btn c-btn--large c-btn--indigo" href="<?php the_field('homepage_second_button_link', 'option') ?>">
                <?php the_field('homepage_second_button_label', 'option') ?>
              </a>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
