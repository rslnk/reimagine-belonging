<main class="c-home js-main-block">
  <div class="o-wrapper">
    <div class="c-home__content js-content-block">

      <?php if( have_rows('homepage_title', 'option') ):
        // Loop through homepage title set in options to render each word
        // or set of words as a separate block
        ?>
        <h1 class="c-home-title">
          <?php while( have_rows('homepage_title', 'option') ): the_row(); ?>
            <?php  if( get_row_layout() == 'word_blocks' ): ?>
              <?php if( have_rows('line_wrapper') ):
                // Check if blocks entered in multiple line. Wrap each line of blocks
                // into individual <ul>
                ?>
                <ul class="c-home-title__line">
                  <?php while( have_rows('line_wrapper') ): the_row(); ?>
                    <li class="c-home-title__block"><?php the_sub_field('block'); ?></li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            <?php endif; ?>
          <?php endwhile; ?>
        </h1>
      <?php endif; ?>

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
