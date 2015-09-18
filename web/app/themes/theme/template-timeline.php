<?php
/**
 * Template Name: Timeline Events (Angular app)
 */
?>
<main class="o-row">
  <div class="o-wrapper">
    <?php get_template_part('templates/page', 'head'); ?>
  </div>
  <div ng-app="eventsApp">
    <div ui-view></div>
  </div>
</main>
