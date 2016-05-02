<?php while(have_posts()): the_post(); ?>

    <?php get_template_part('components/page-head'); ?>

    <div class="c-page__content">
        <?php get_template_part('content/page'); ?>
        <?php get_template_part('components/sidebar-page'); ?>
    </div>

<?php endwhile; ?>
