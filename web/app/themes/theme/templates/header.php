<?php use Roots\Sage\Nav\NavWalker; ?>

<header class="c-site-head">
  <div class="o-wrapper">
    <nav class="c-site-nav">
      <a href="<?= esc_url(home_url('/')); ?>" class="o-site-logo c-site-logo--nav u-icon u-icon-logo">
        <?php bloginfo('name'); ?>
      </a>
      <?php
      if (has_nav_menu('primary_navigation')) :
        wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'c-site-nav__list']);
      endif;
      ?>
    </nav>
  </div>
</header>