<div class="c-page__sidebar">
  <div class="c-sidebar__sidenote">

    <?php if(get_field('page_sidenote_title')) :?>
      <h2 class="o-heading c-sidebar-note__text c-sidebar-note__text--page">
        <?php the_field('page_sidenote_title') ?>
      </h2>
    <?php endif; ?>

    <?php if(get_field('page_sidenote_text')) :?>
      <p class="o-paragraph c-paragraph--sidebar c-sidebar-note__caption">
        <?php the_field('page_sidenote_text') ?>
      </p>
    <?php endif; ?>

  </div>
</div>
