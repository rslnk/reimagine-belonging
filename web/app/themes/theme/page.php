<?php while (have_posts()) : the_post(); ?>
  <main class="o-row">
    <div class="o-wrapper">
      <?php get_template_part('templates/page', 'head'); ?>
      <?php get_template_part('templates/content', 'page'); ?>
      <?php get_template_part('templates/sidebar', 'page'); ?>
    </div>
  </main>
<?php endwhile; ?>
