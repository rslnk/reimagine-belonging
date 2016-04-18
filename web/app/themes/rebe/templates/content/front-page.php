<main class="c-home__content js-content">
  <?php if( have_rows('front_page_tagline')):
    // Loop through homepage title set in options to render each word
    // or set of words as a separate block
    ?>
    <h1 class="c-tagline">
      <?php while( have_rows('front_page_tagline')): the_row(); ?>
        <?php  if( get_row_layout() == 'word_blocks' ): ?>
          <?php if( have_rows('line_wrapper')):
            // Check if blocks entered in multiple line. Wrap each line of blocks
            // into individual <ul>
            ?>
            <div class="c-tagline__linebreak">
              <?php while( have_rows('line_wrapper')): the_row(); ?>
                <span class="c-tagline__word"><?php the_sub_field('block'); ?></span>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        <?php endif; ?>
      <?php endwhile; ?>
    </h1>
  <?php endif; ?>

  <div class="c-home__cta">
    <?php if(get_field('front_page_first_button_text')):?>
      <a class="c-cta-button--home" href="/<?php the_field('front_page_first_button_url', 'option'); ?>">
        <span class="o-icon c-icon-play--circle c-cta-button__icon"></span>
        <span class="c-cta-button__label"><?php the_field('front_page_first_button_text'); ?></span>
      </a>
    <?php endif; ?>
    <?php if(get_field('front_page_second_button_text')):?>
      <a class="c-cta-button--home" href="/<?php the_field('front_page_second_button_url', 'option'); ?>">
        <span class="o-icon c-icon-time--circle c-cta-button__icon"></span>
        <span class="c-cta-button__label"><?php the_field('front_page_second_button_text'); ?></span>
      </a>
    <?php endif; ?>
  </div>
</main>

<div class="c-home__tanya-image"></div>
