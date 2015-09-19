<main class="c-home js-main-block">
  <div class="o-wrapper">
    <div class="c-home__content js-content-block">
      <h1 class="c-home-title">
        <ul class="c-home-title__line">
          <li class="c-home-title__block">Stories of</li>
          <li class="c-home-title__block">Migration</li>
          <li class="c-home-title__block">and</li>
          <li class="c-home-title__block">Belonging</li>
        </ul>
        <ul class="c-home-title__line">
          <li class="c-home-title__block">New visions of Citizenship</li>
        </ul>
      </h1>
      <div class="c-home-buttons__wrap">
        <?php if(get_field('homepage_first_button_label', 'option')) :?>
          <a class="c-home-buttons__item o-btn c-btn--large c-btn--mint u-margin--home-intro-button" href="<?php the_field('homepage_first_button_link', 'option') ?>">
            <?php the_field('homepage_first_button_label', 'option') ?>
          </a>
        <?php endif; ?>
        <?php if(get_field('homepage_second_button_label', 'option')) :?>
          <a class="c-home-buttons__item o-btn c-btn--large c-btn--indigo" href="<?php the_field('homepage_second_button_link', 'option') ?>">
            <?php the_field('homepage_second_button_label', 'option') ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</main>
