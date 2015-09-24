<main class="o-row c-404">
  <div class="u-centering-wrapper js-main-block">
    <div class="u-centered">
      <div class="o-wrapper">
        <div class="c-404__content">

          <?php if(get_field('404_title', 'option')) :?>
            <h1 class="o-heading c-404__title">
              <?php the_field('404_title', 'option') ?>
            </h1>
          <?php endif; ?>

          <?php if(get_field('404_subtitle', 'option' )) :?>
            <p class="o-paragraph c-404__subtitle">
              <?php the_field('404_subtitle', 'option') ?>
            </p>
          <?php endif; ?>

        </div>
      </div>
    </div>
  </div>
</main>
