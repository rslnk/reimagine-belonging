<header class="c-head">
    <nav class="c-head-menu">
        <a href="<?= esc_url(home_url('/')); ?>" class="c-head__logo">
            <h1 class="u-visually-hidden"><?php bloginfo('name'); ?></h1>
        </a>
        <a class="o-icon c-icon-more--circle c-head-menu__toggle js-modal-menu-open" data-target=".js-modal-menu"></a>
        <?php
            if (has_nav_menu('primary_navigation')) :
                wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class'     => 'c-head-menu__list'
                ]);
            endif;
        ?>
    </nav>
</header>
