<div class="c-page__sidebar">
  <div class="c-sidebar__sidenote">

    <?php if(get_field('page_sidenote_title')) :?>
      <h2 class="o-heading c-heading--page-sidebar-note c-heading--page-sidebar-note--mint">
        <?php the_field('page_sidenote_title') ?>
      </h2>
    <?php endif; ?>

    <?php if(get_field('page_sidenote_text')) :?>
      <p class="c-paragraph--sidebar c-paragraph--sidebar--grey">
        <?php the_field('page_sidenote_text') ?>
      </p>
    <?php endif; ?>

  </div>
</div>