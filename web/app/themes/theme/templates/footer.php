<?php use Roots\Sage\Nav\NavWalker; ?>

<footer class="c-site-footer" role="contentinfo">
  <div class="o-wrapper">
    <nav class="o-site-nav c-site-nav--footer">
      <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(['theme_location' => 'secondary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'c-site-nav__list _c-site-nav__list--footer']);
      endif;
      ?>
      <ul class="c-site-nav__list _c-site-nav__list--footer c-site-nav__list--footer-extra">
        <li class="li"><a href="#">Sign up</a></li>
        <li class="li"><a href="#">Sprechen sie Deutsch?</a></li>
      </ul>
    </nav>
  </div>
</footer>
