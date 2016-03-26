<?php while (have_posts()) : the_post(); ?>
  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('components/entry-meta'); ?>
    </header>
    <div class="s-headings s-paragraphs s-links s-text-lists">
      <?php the_content(); ?>
    </div>
    <footer>
      <?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'rebe'), 'after' => '</p></nav>']); ?>
    </footer>
    <?php comments_template('/components/comments.php'); ?>
  </article>
<?php endwhile; ?>
