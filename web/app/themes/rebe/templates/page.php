
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('content/post-types/page/page'); ?>
<?php endwhile; ?>