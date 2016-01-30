<footer class="c-site-footer">
  <div class="o-wrapper">
    <nav class="o-site-nav c-site-nav--footer">
      <?php
      if (has_nav_menu('secondary_navigation')) :
        wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'o-site-nav__list c-site-nav__list--footer']);
      endif;
      ?>
      <ul class="c-site-footer__social-icons">
        <li>
          <a class="o-icons-list__link o-icon c-icon-facebook-negative" href="https://www.facebook.com/withWINGSandROOTS">Facebook</a>
        </li>
        <li>
          <a class="o-icons-list__link o-icon c-icon-twitter-negative" href="https://www.twitter.com/wingsrootsfilm">Twitter</a>
        </li>
      </ul>
      <?php if(get_field('footer_language_switcher_text', 'option') && get_field('footer_language_switcher_url', 'option')): ?>
        <div class="c-site-footer__language-switcher">
          <a href="<?php the_field('footer_language_switcher_url', 'option'); ?>"><?php the_field('footer_language_switcher_text', 'option'); ?></a>
        </div>
      <?php endif; ?>
    </nav>
  </div>
</footer>
<?php get_template_part('templates/modal', 'donate'); ?>
