<?php while (have_posts()) : the_post(); ?>
  <article class="event-post">
    <header>
      <div class="event-date">
        <?= Roots\Sage\Extras\list_custom_taxonomies_terms(); ?>
      </div>
      <h1 class="event-title"><?php the_title(); ?></h1>
      <?php if (get_field('subtitle')): ?>
        <h2 class="post-subtitle"><?php the_field('subtitle'); ?></h2>
      <?php endif; ?>
    </header>
    <div class="post-content">
      <?php the_field('main_content'); ?>
    </div>
    <footer></footer>
  </article>
<?php endwhile; ?>

<?php  ?>
