<?php use Roots\Sage\Nav\NavWalker; ?>

<footer class="c-site-footer" role="contentinfo">
  <div class="o-wrapper">
    <nav class="c-footer-links">
      <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(['theme_location' => 'secondary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'c-site-nav__list']);
      endif;
      ?>
    </nav>
  </div>
</footer>
