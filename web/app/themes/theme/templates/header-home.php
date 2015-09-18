<?php use Roots\Sage\Nav\NavWalker; ?>

<header class="c-site-head c-site-head--home">
  <div class="o-wrapper">
    <nav class="o-site-nav c-site-nav--head">
      <a href="<?= esc_url(home_url('/')); ?>" class="o-site-logo c-site-logo--nav c-site-logo--nav--home u-icon u-icon-logo-negative">
        <?php bloginfo('name'); ?>
      </a>
      <a class="c-site-nav__menu-toggle c-site-nav__menu-toggle--home js-toggle-nav-menu u-icon u-icon-menu-mint"></a>
      <?php
        if (has_nav_menu('primary_navigation')) :
          wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'o-site-nav__list c-site-nav__list--head c-site-nav__list--head--home']);
        endif;
      ?>
    </nav>
  </div>
</header>
