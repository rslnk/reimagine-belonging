<?php

/*

    Template Name: Stories

    This template is used to output the list of stories post type.

    Angular app: stories

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
    <div ng-app="storiesApp">
      <div ui-view></div>
    </div>
  <?php else: ?>
    <div>hellow, crawler or bot</div>
  <?php endif; ?>
</main>
