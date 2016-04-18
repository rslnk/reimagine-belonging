<?php while(have_posts()): the_post(); ?>

    <div class="c-page">

        <?php get_template_part('components/page-head'); ?>

        <div class="o-centered-content">

            <div class="c-page__content">
                <?php get_template_part('content/page'); ?>
                <?php get_template_part('components/sidebar-page'); ?>
            </div>

        </div>

    </div>

<?php endwhile; ?>
