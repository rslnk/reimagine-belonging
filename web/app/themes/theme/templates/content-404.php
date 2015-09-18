<main class="o-row c-404" style="background-image: url(<? echo get_template_directory_uri() ?>/assets/images/homepage-intro-image--1.0.jpg);">
  <div class="u-centering-wrapper js-main-block">
    <div class="u-centered">
      <div class="o-wrapper">
        <div class="c-404__content">
          <div class="c-404__title">
            <?php if(get_field('404_title', 'option')) :?>
              <h1 class="o-heading c-heading--404-title t-negative">
                <?php the_field('404_title', 'option') ?>
              </h1>
            <?php endif; ?>
          </div>
          <?php if(get_field('404_subtitle', 'option' )) :?>
            <h2 class="o-heading c-heading--404-subtitle t-negative">
              <?php the_field('404_subtitle', 'option') ?>
            </h2>
          <?php endif; ?>
          <div class="c-404__message"></div>
            <?php if(get_field('404_text', 'option' )) :?>
              <p class="o-heading c-paragraph--404-message t-negative">
                <?php the_field('404_text', 'option') ?>
              </p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
