<div class="c-page__sidebar">

  <div class="c-sidenote">

    <?php if(get_field('page_sidenote_title')) :?>
      <h2 class="c-sidenote__title--page">
        <?php the_field('page_sidenote_title') ?>
      </h2>
    <?php endif; ?>

    <?php if(get_field('page_sidenote_text')) :?>
      <div class="c-sidenote__caption s-paragraphs--small s-links">
        <?php the_field('page_sidenote_text') ?>
      </div>
    <?php endif; ?>

  </div>

</div>
