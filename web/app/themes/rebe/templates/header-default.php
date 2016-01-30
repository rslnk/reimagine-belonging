<header class="c-site-head">
  <div class="o-wrapper">
    <nav class="o-site-nav c-site-nav--head">
      <a href="<?= esc_url(home_url('/')); ?>" class="o-site-logo c-site-logo--nav o-icon c-icon-logo">
        <?php bloginfo('name'); ?>
      </a>
      <?php if (get_field('donate_button_label', 'option')): ?>
        <div class="c-donate-button c-donate-button js-lightbox-open--donate">
          <div class="c-donate-button__text">
            <?php the_field('donate_button_label', 'option'); ?>
          </div>
        </div>
      <?php endif; ?>
      <a class="c-site-nav__menu-toggle js-toggle-nav-menu o-icon c-icon-menu"></a>
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'o-site-nav__list c-site-nav__list--head c-site-nav__list--head--page']);
        endif;
      ?>
    </nav>
  </div>
</header>
