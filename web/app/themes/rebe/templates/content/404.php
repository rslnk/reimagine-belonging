<main class="c-404__content js-content">

    <?php if(get_field('404_title', 'option')) :?>
        <h1 class="o-heading c-404__title">
            <?php the_field('404_title', 'option') ?>
        </h1>
    <?php endif; ?>

    <?php if(get_field('404_subtitle', 'option' )) :?>
        <p class="o-paragraph c-404__text">
            <?php the_field('404_subtitle', 'option') ?>
        </p>
    <?php endif; ?>

</main>
