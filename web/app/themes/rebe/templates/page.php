<?php while (have_posts()) : the_post(); ?>
  <main class="o-row">
    <div class="o-wrapper">
      <?php get_template_part('components/page-head'); ?>
      <?php get_template_part('content/page'); ?>
      <?php get_template_part('components/sidebar-page'); ?>
    </div>
  </main>
<?php endwhile; ?>
