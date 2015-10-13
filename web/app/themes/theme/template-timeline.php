<?php

/*

    Template Name: Timeline Events

    This template is used to output the list of events post type.

    Angular app: events

    is_bot(); function checks if user-agent is not a bot or crawler and based
    on the result outputs either standard WordPress loop if the user-agent is
    bot, or Angular app if user-agent is human.

 */

use BaseSetup\Redirects\UserAgentCheck;

?>
<main class="o-row">
  <div class="o-wrapper">
    <?php get_template_part('templates/page', 'head'); ?>
  </div>
  <?php if(!UserAgentCheck\is_bot()): ?>
    <div ng-app="eventsApp">
      <div ui-view></div>
    </div>
  <?php else: ?>
    <?php get_template_part('templates/content', 'events'); ?>
  <?php endif; ?>
</main>
