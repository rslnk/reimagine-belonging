<?php use ReBe\Routing\UserAgent;

/**
 * Template Name: Stories
 *
 * Lists all 'story' post type entries.
 *
 * Depending on user agent check this template outputs two separate views:
 * Content for crawlers and AngularJS view if user agent is NOT a crawler.
 * @uses events app (AngularJS)
 * @see assets/ng/events
 */
?>
<main class="c-stories__content">
  <?php if (UserAgent::check('crawler')) :  ?>
  <?php get_template_part('content/pages/stories/crawler/stories') // Output content for crawlers; ?>
  <?php else : // Output Angular app for user; ?>
  <div ng-app="storiesApp"><div ui-view></div></div>
  <?php endif; ?>
</main>