<div class="c-page__sidebar">

  <div class="o-sidenote">

    <?php if(get_field('page_sidenote_title')) :?>
      <h2 class="o-heading o-sidenote__title--page">
        <?php the_field('page_sidenote_title') ?>
      </h2>
    <?php endif; ?>

    <?php if(get_field('page_sidenote_text')) :?>
      <div class="o-sidenote__caption s-paragraphs--small s-links">
        <?php the_field('page_sidenote_text') ?>
      </div>
    <?php endif; ?>

  </div>

</div>
