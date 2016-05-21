
<?php if(get_post_type() == 'event' || 'story') { $subdir = '/crawler'; } else { $subdir = null; }; ?>
<?php while (have_posts()) : the_post(); ?>
<?php get_template_part('content/post-types/' . get_post_type() . $subdir . '/single'); ?>
<?php endwhile; ?>