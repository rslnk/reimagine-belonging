<?php use Roots\Sage\Nav\NavWalker; ?>

<footer class="c-site-footer" role="contentinfo">
  <div class="o-wrapper">
    <nav class="o-site-nav c-site-nav--footer">
      <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(['theme_location' => 'secondary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'o-site-nav__list c-site-nav__list--footer']);
      endif;
      ?>
      <ul class="o-social-icons__list c-social-icons__list--site-footer">
        <li class="o-social-icons__item o-social-icons__item--site-footer">
          <a class="o-icons-list__link c-icons-list__link--site-footer u-icon u-icon-facebook-negative" href="https://www.facebook.com/withWINGSandROOTS">Facebook</a>
        </li>
        <li class="o-social-icons__item o-social-icons__item--site-footer">
          <a class="o-icons-list__link c-icons-list__link--site-footer u-icon u-icon-twitter-negative" href="https://www.twitter.com/wingsrootsfilm">Twitter</a>
        </li>
      </ul>
    </nav>
  </div>
</footer>
