<footer class="c-footer js-footer">

    <div class="c-footer__content">

        <?php
            // Get footer menus
            get_template_part('components/footer-directory');
        ?>


        <div class="c-locale">
            <?php
                // Get locale
                if(get_field('site_alternative_locale_url', 'option') && get_field('footer_alternative_locale_button_text', 'option')):?>

                <a href="<?php the_field('site_alternative_locale_url', 'option'); ?>" class="c-locale__button">
                    <span class="c-locale__text"><?php the_field('footer_alternative_locale_button_text', 'option'); ?></span>
                    <span class="o-icon c-icon-arrow--circle c-locale__icon"></span>
                </a>
            <?php endif; ?>
        </div>


        <div class="c-legal">

            <?php
                // Get 'legal links' navigation
                if (has_nav_menu('optional_navigation')) :
                    wp_nav_menu([
                    'theme_location' => 'optional_navigation',
                    'menu_class'     => 'c-legal__links'
                ]);
                endif;
            ?>

            <?php if (get_field('footer_copyright_notice_part_1', 'option')): ?>

                <div class="c-copyright-notice">
                    <span><?php the_field('footer_copyright_notice_part_1', 'option'); ?></span>
                    <span> <?php echo date("Y") ?> </span>
                    <span><?php the_field('footer_copyright_notice_part_2', 'option'); ?></span>
                </div>

            <?php endif; ?>

        </div>

    </div>

</footer>

<?php
  // Mobile menu modal
  get_template_part('components/modal-menu');
?>
