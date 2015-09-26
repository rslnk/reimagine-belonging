<?php
/**
 * Template Name: Stories (Angular app)
 */
require_once( __DIR__ . '/../../mu-plugins/base-setup/is-bot.php');
?>
<main class="o-row">
  <div class="o-wrapper">
    <?php get_template_part('templates/page', 'head'); ?>
  </div>
  <?php if (!is_bot()) { ?>
    <div ng-app="storiesApp">
      <div ui-view></div>
    </div>
  <?php } else { ?>
    <div>hello, crawler or bot!</div>
  <?php } ?>
</main>
