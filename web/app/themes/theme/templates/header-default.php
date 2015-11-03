<header class="c-site-head">
  <div class="o-wrapper">
    <nav class="o-site-nav c-site-nav--head">
      <a class="c-donate-button">
        Donate
      </a>
      <a href="<?= esc_url(home_url('/')); ?>" class="o-site-logo c-site-logo--nav o-icon c-icon-logo">
        <?php bloginfo('name'); ?>
      </a>
      <a class="c-site-nav__menu-toggle js-toggle-nav-menu o-icon c-icon-menu-mint"></a>
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'o-site-nav__list c-site-nav__list--head c-site-nav__list--head--page']);
        endif;
      ?>
    </nav>
  </div>
</header>
