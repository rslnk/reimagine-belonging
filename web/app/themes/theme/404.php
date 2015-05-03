<main class="o-wrapper--row c-404" style="background-image: url(<? echo get_template_directory_uri() ?>/assets/images/homepage-intro-image--1.0.jpg);">

  <div class="u-centering-wrapper js-main-block">
    <div class="u-centered">
      <div class="o-wrapper">
        <div class="c-404__content">
          <div class="c-404-title">
            <?php if(get_field('404_title', 'option')) :?>
              <h1 class="o-heading c-heading--page-subtitle t-negative">
                <?php the_field('404_title', 'option') ?>
              </h1>
            <?php endif; ?>
          </div>
          <?php if(get_field('404_subtitle', 'option' )) :?>
            <h2 class="o-heading c-heading--page-title t-negative">
              <?php the_field('404_subtitle', 'option') ?>
            </h2>
          <?php endif; ?>
          <div class="c-404_message"></div>
            <?php if(get_field('404_text', 'option' )) :?>
              <h3 class="o-heading c-heading--page-sidebar-title t-negative">
                <?php the_field('404_text', 'option') ?>
              </h3>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</main>