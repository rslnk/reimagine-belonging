<main class="c-home js-home">
    <div class="c-home__content js-home-content">

      <?php if( have_rows('front_page_tagline')):
        // Loop through homepage title set in options to render each word
        // or set of words as a separate block
        ?>
        <h1 class="c-home-title">
          <?php while( have_rows('front_page_tagline')): the_row(); ?>
            <?php  if( get_row_layout() == 'word_blocks' ): ?>
              <?php if( have_rows('line_wrapper')):
                // Check if blocks entered in multiple line. Wrap each line of blocks
                // into individual <ul>
                ?>
                <ul class="c-home-title__line">
                  <?php while( have_rows('line_wrapper')): the_row(); ?>
                    <li class="c-home-title__block"><?php the_sub_field('block'); ?></li>
                  <?php endwhile; ?>
                </ul>
              <?php endif; ?>
            <?php endif; ?>
          <?php endwhile; ?>
        </h1>
      <?php endif; ?>

      <div class="c-home-buttons__wrap">
        <?php if(get_field('front_page_first_button_text')):?>
          <a class="c-home-buttons__item o-btn o-btn--large t-mint--focus" href="/<?php the_field('front_page_first_button_url', 'option'); ?>">
            <?php the_field('front_page_first_button_text'); ?>
          </a>
        <?php endif; ?>
        <?php if(get_field('front_page_second_button_text')):?>
          <a class="c-home-buttons__item o-btn o-btn--large t-indigo--focus" href="/<?php the_field('front_page_second_button_url', 'option'); ?>">
            <?php the_field('front_page_second_button_text'); ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
</main>
