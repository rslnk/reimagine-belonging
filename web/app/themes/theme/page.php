<main class="o-wrapper">
  <div class="o-wrapper--row">
    <?php while (have_posts()) : the_post(); ?>
      <h1 class="o-heading c-heading--page-title"><?php the_field('subtitle'); ?></h1>
      <?php get_template_part('templates/content', 'page'); ?>
      <?php get_template_part('templates/sidebar', 'page'); ?>
    <?php endwhile; ?>
  </div>
</main>