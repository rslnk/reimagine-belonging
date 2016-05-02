<?php

use ReBe\Routing\UserAgent;

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
    <?php
    // Output content for crawlers
    if (UserAgent::check('crawler')): get_template_part('content/stories'); ?>
    <?php else: ?>
        <div ng-app="storiesApp">
            <div ui-view></div>
        </div>
    <?php endif; ?>
</main>
