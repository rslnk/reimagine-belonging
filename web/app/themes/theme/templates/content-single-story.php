<?php use Roots\Sage\Utils; ?>

<?php while (have_posts()) : the_post(); ?>
  <article class="o-wrapper">
    <header class="c-story__header">

      <?= Roots\Sage\Extras\list_categories(); ?>

      <h1 class="o-heading c-heading--story-title"><?php the_title(); ?></h1>
      <?php
        $story_post_cities 		= wp_get_object_terms($post->ID, 'story_city');
        $city_name        		= $story_post_cities[0]->name;
       ?>
       <h2 class="c-story__hero"><strong><?php the_field('protagonist_name');  echo ', ' ?></strong><?php echo $city_name; ?></h2>

    </header>

    <div class="o-row c-story__content">

      <div class="c-story__body o-wp-editor">
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
        <?php if(get_field('subtitles_notification') == 1): ?>
          <div class="c-closed-captions-notice">
            <div class="u-icon u-icon-closed-captions c-closed-captions-notice__icon"></div>
            <div class="c-closed-captions-notice__wrapper">
              <h3 class="o-heading c-closed-captions-notice__title"><?php the_field('story_cc_notice_title', 'option') ?></h3>
              <p class="o-paragraph c-paragraph--sidebar c-closed-captions-notice__text"><?php the_field('story_cc_notice_text', 'option') ?></p>
            </div>
          </div>
        <?php endif; ?>
        <?php if(get_field('excerpt')): ?>
          <div class="c-story__quote">
            <div class="u-icon u-icon-quotation-mark-blueberry c-sidebar-quote__icon c-sidebar-quote__icon--story"></div>
            <h2 class="o-heading c-sidebar-quote__text c-sidebar-quote__text--story"><?php the_field('excerpt'); ?></h2>
            <div class="c-sidebar-quote__author-block c-sidebar-quote__author-block--story">
              <span class="c-sidebar-quote__dash">—</span>
              <span class="c-sidebar-quote__author"><?php the_field('protagonist_name'); ?></span>
            </div>
          </div>
        <?php endif; ?>
        <!-- soicail shares -->
        <ul class="o-social-icons o-social-icons__list c-social-icons__list--post-share">
          <li class="o-social-icons__item">
            <a class="o-icons-list__link c-icons-list__link--post-share u-icon u-icon-facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{ shareUrl }}">Facebook Share</a>
          </li>
          <li class="o-social-icons__item">
            <a class="o-icons-list__link c-icons-list__link--post-share u-icon u-icon-twitter" href="http://www.twitter.com/share?url={{ shareUrl }}">Tweet</a>
          </li>
        </ul>
      </div> <!-- sidebar_content -->

    </div>
  </article>
<?php endwhile; ?>
