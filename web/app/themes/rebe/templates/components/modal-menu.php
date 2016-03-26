<div class="c-modal-menu js-modal-menu">

    <div class="u-centering-wrapper">

        <a class="o-icon c-icon-close--circle c-modal-menu__close js-modal-menu-close" data-target=".js-modal-menu"></a>

        <nav class="u-centered">

            <?php
                if (has_nav_menu('modal_navigation')) :
                    wp_nav_menu([
                        'theme_location' => 'modal_navigation',
                        'menu_class'     => 'c-modal-menu__list'
                    ]);
                endif;
            ?>

        </nav>

    </div>

</div>
