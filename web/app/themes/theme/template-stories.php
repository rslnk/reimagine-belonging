<?php
/**
 * Template Name: Stories
 */
?>
<main class="o-wrapper--row c-home-intro">
  <div>
    <h1 class="o-heading c-heading--page-title">
      <?php the_field('subtitle') ?>
    </h1>
  </div>
  <div ng-app="storiesApp">
    <div ui-view></div>
  </div>
</main>
