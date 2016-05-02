<div class="c-directories">

    <?php
    // Footer directory section 1
    if (has_nav_menu('directory_section_1')) : ?>

        <div class="c-directories__section">

            <?php if (get_field('footer_directory_section_title_1', 'option')): ?>
                <h4 class="c-directories__title">
                    <?php the_field('footer_directory_section_title_1', 'option'); ?>
                </h4>
                <div data-target=".js-directory-list-1" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>

            <?php endif; ?>

            <?php
                wp_nav_menu([
                    'theme_location' => 'directory_section_1',
                    'menu_class'     => 'c-directories__list js-directory-list-1'
                ]);
            ?>

        </div>

    <?php endif; ?>

    <?php
    // Footer directory section 2
    if (has_nav_menu('directory_section_2')) : ?>

        <div class="c-directories__section">

            <?php if (get_field('footer_directory_section_title_2', 'option')): ?>
                <h4 class="c-directories__title">
                    <?php the_field('footer_directory_section_title_2', 'option'); ?>
                </h4>
                <div data-target=".js-directory-list-2" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>

            <?php endif; ?>

            <?php
                wp_nav_menu([
                    'theme_location' => 'directory_section_2',
                    'menu_class'     => 'c-directories__list js-directory-list-2'
                ]);
            ?>

        </div>

    <?php endif; ?>

    <?php
    // Footer directory section 3
    if (has_nav_menu('directory_section_3')) : ?>

        <div class="c-directories__section">

            <?php if (get_field('footer_directory_section_title_3', 'option')): ?>
                <h4 class="c-directories__title">
                    <?php the_field('footer_directory_section_title_3', 'option'); ?>
                </h4>
                <div data-target=".js-directory-list-3" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>

            <?php endif; ?>

            <?php
                wp_nav_menu([
                    'theme_location' => 'directory_section_3',
                    'menu_class'     => 'c-directories__list js-directory-list-3'
                ]);
            ?>

        </div>

    <?php endif; ?>

    <?php
    // Footer directory section 4
    if (has_nav_menu('directory_section_4')): ?>

        <div class="c-directories__section">

            <?php if (get_field('footer_directory_section_title_4', 'option')): ?>
                <h4 class="c-directories__title">
                    <?php the_field('footer_directory_section_title_4', 'option'); ?>
                </h4>
                <div data-target=".js-directory-list-4" class="c-icon-plus--circle c-directories__toggle js-directory-section-toggle"></div>

            <?php endif; ?>

            <?php
                wp_nav_menu([
                    'theme_location' => 'directory_section_4',
                    'menu_class'     => 'c-directories__list js-directory-list-4'
                ]);
            ?>

            <!-- Social links -->

                <ul class="c-social-links__list">
                    <?php if(get_field('facebook_page_url', 'option')):?>
                        <li class="c-social-links__item">
                            <a class="c-icon-facebook--circle c-social-links__icon" href="<?php the_field('facebook_page_url', 'option'); ?>">
                                <span class="u-visually-hidden">
                                    <?php the_field('facebook_page_url_label', 'option'); ?>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(get_field('twitter_url', 'option')):?>
                        <li class="c-social-links__item">
                            <a class="c-icon-twitter--circle c-social-links__icon" href="<?php the_field('twitter_url', 'option'); ?>">
                                <span class="u-visually-hidden">
                                    <?php the_field('twitter_account_url_label', 'option'); ?>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(get_field('vimeo_url', 'option')):?>
                        <li class="c-social-links__item">
                            <a class="c-icon-vimeo--circle c-social-links__icon" href="<?php the_field('vimeo_url', 'option'); ?>">
                                <span class="u-visually-hidden">
                                    <?php the_field('vimeo_account_url_label', 'option'); ?>
                                </span>
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>

        </div>
    <?php endif; ?>

</div>
