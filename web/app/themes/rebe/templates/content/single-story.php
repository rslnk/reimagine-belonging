<?php while (have_posts()) : the_post(); ?>
  <article class="c-story">

    <header class="c-story__header">

      <?= Apps\list_categories(); ?>

      <h1 class="c-story__title"><?php the_title(); ?></h1>
      <?php
        $story_post_cities 		= wp_get_object_terms($post->ID, 'story_city');
        $city_name        		= $story_post_cities[0]->name;
       ?>
       <h2 class="c-story__protagonist"><strong><?php the_field('protagonist_name');  echo ', ' ?></strong><?php echo $city_name; ?></h2>

    </header>

    <div class="c-story__content">

      <div class="c-story__main s-headings s-paragraphs s-links s-text-lists">
        <div class="u-video-container c-story__video">

          <?php if(get_field('story_video_host') == 'youtube'): ?>
            <div class="u-video-container">
              <iframe src="http://www.youtube.com/embed/<?php the_field('story_video_id'); ?>?modestbranding=0&nologo=1&iv_load_policy=3&autoplay=0&showinfo=0&controls=1&cc_load_policy=1&rel=0" frameborder="0" allowfullscreen></iframe>
            </div>
          <?php elseif(get_field('story_video_host') == 'vimeo'): ?>
            <div class="u-video-container">
              <iframe src="https://player.vimeo.com/video/<?php the_field('story_video_id'); ?>?title=0&byline=0"></iframe>
            </div>
          <?php else: ?>
            <!-- oEmbeded video code goes here -->
          <?php endif; ?>

        </div>
      </div>

      <div class="c-story__sidebar">

          <?php if(get_field('excerpt')): ?>
            <div class="c-story-quote">
              <div class="o-icon c-icon-quote c-event-quote__icon"></div>
              <h2 class="c-story-quote__text"><?php the_field('excerpt'); ?></h2>
              <div class="c-story-quote__meta">
                <span>—</span>
                <span class="c-story-quote__author"><?php the_field('protagonist_name'); ?></span>
                <span class="c-story-quote__city"><?php echo $city_name; ?></span>
              </div>
            </div>
          <?php endif; ?>

        <?php if(get_field('subtitles_notification') == 1): ?>
          <div class="c-closed-captions-notice">
            <div class="o-icon c-icon-closed-captions c-closed-captions-notice__icon"></div>
            <div class="c-closed-captions-notice__content">
              <h3 class="c-closed-captions-notice__title"><?php the_field('story_cc_notice_title', 'option') ?></h3>
              <p class="c-closed-captions-notice__text"><?php the_field('story_cc_notice_text', 'option') ?></p>
            </div>
          </div>
        <?php endif; ?>

        <!-- share story -->
        <ul class="c-post-share__list">
          <li class="c-post-share__item">
            <a class="o-icon c-icon-facebook--circle c-post-share__link--story" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{ shareUrl }}">
              <span class="u-visually-hidden">Share on Facebook</span>
            </a>
          </li>
          <li class="c-post-share__item">
            <a class="o-icon c-icon-twitter--circle c-post-share__link--story" target="_blank" href="http://www.twitter.com/share?url={{ shareUrl }}">
              <span class="u-visually-hidden">Share on Twitter</span>
            </a>
          </li>
        </ul>

      </div> <!-- sidebar_content -->

    </div>
  </article>
<?php endwhile; ?>
