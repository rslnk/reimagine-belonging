<?php

use ReBe\Routing\UserAgent;

/**
 * Template Name: Events
 *
 * Lists all 'event' post type entries.
 *
 * Depending on user agent check this template outputs two separate views:
 * Content for crawlers and AngularJS view if user agent is NOT a crawler.
 * @uses events app (AngularJS)
 * @see assets/ng/events
 */
?>
<main class="o-row">
    <div class="o-wrapper">
        <?php get_template_part('components/page-head'); ?>
    </div>
    <?php
    // Output content for crawlers
    if (UserAgent::check('crawler')): get_template_part('content/events'); ?>
    <?php else: ?>
        <div ng-app="eventsApp">
            <div ui-view></div>
        </div>
    <?php endif; ?>
</main>
