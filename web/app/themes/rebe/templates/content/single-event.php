<?php while (have_posts()) : the_post(); ?>
  <article class="c-event">
      
    <header class="c-hero--event">

      <?= App\list_categories(); ?>

      <h1 class="c-event__title"><?php the_title(); ?></h1>
      <?php if (get_field('subtitle')): ?>
        <h2 class="post-subtitle"><?php the_field('subtitle'); ?></h2>
      <?php endif; ?>
      <div class="c-event__date">
        <?php
          // Display human readable date
          if(get_field('unknown_date') == 0) {
            $start_date_full = get_field('start_date');
            $start_date = date("F jS, Y",strtotime($start_date_full));
            $end_date_full = get_field('end_date');
            $end_date = date("F jS, Y",strtotime($end_date_full));
          }
          else {
            $start_date_full = get_field('start_date');
            $start_date = date("Y",strtotime($start_date_full));
            $end_date_full = get_field('end_date');
            $end_date = date("Y",strtotime($end_date_full));
          }
        ?>
        <dateformat><?php echo $start_date; ?></dateformat>
        <span> &mdash; </span>
        <dateformat><?php echo $end_date; ?></dateformat>
      </div>
      <!-- share event -->
      <ul class="c-post-sharing__list">
        <li class="c-post-sharing__item">
          <a class="o-icon c-icon-facebook--circle c-post-sharing__link--event" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{ shareUrl }}">
            <span class="u-visually-hidden">Share on Facebook</span>
          </a>
        </li>
        <li class="c-post-sharing__item">
          <a class="o-icon c-icon-twitter--circle c-post-sharing__link--event" target="_blank" href="http://www.twitter.com/share?url={{ shareUrl }}">
            <span class="u-visually-hidden">Share on Twitter</span>
          </a>
        </li>
      </ul>
    </header>

    <div class="c-event__content">

      <div class="c-event__main s-headings s-paragraphs s-links s-text-lists">
        <?php the_field('main_content'); ?>
      </div>

      <?php if(get_field('sidebar_content')): ?>
        <?php while( have_rows('sidebar_content') ): the_row(); ?>
          <div class="c-event__sidebar">

            <?php if(get_sub_field('sidebar_content_type') == 'video'): ?>
              <div class="c-media-block">
                <?php while( have_rows('video') ): the_row(); ?>
                  <?php if(get_sub_field('video_host') == 'youtube'): ?>
                    <div class="u-video-container">
                      <iframe src="http://www.youtube.com/embed/<?php the_sub_field('id'); ?>?modestbranding=0&nologo=1&iv_load_policy=3&autoplay=0&showinfo=0&controls=1&cc_load_policy=1&rel=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                  <?php else: ?>
                    <div class="u-video-container">
                      <iframe src="https://player.vimeo.com/video/<?php the_sub_field('id'); ?>?title=0&byline=0"></iframe>
                    </div>
                  <?php endif; ?>

                  <?php if (get_sub_field('credit')): ?>
                    <a class="c-media-credits" href="<?php the_sub_field('credit_link'); ?>">
                      <?php the_sub_field('credit'); ?>
                    </a>
                  <?php endif; ?>
                  <h4 class="o-heading c-media-block__title"><?php the_sub_field('title'); ?></h4>
                  <p class="c-media-block__caption"><?php the_sub_field('caption'); ?></p>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

            <?php if(get_sub_field('sidebar_content_type') == 'image'): ?>
              <div class="c-media-block">
                <?php while( have_rows('image') ): the_row(); ?>
                  <?php if(get_sub_field('url')): ?>
                    <div class="u-image-cover u-image-cover--4x3 c-media-block__placeholder" style="background-image: url(<?php the_sub_field('url'); ?>)"></div>
                  <?php endif; ?>

                  <?php if (get_sub_field('credit')): ?>
                    <a class="c-media-block__credits" href="<?php the_sub_field('credit_link'); ?>">
                      <?php the_sub_field('credit'); ?>
                    </a>
                  <?php endif; ?>
                  <h4 class="c-media-block__title"><?php the_sub_field('title'); ?></h4>
                  <p class="c-media-block__caption"><?php the_sub_field('caption'); ?></p>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

            <?php if(get_sub_field('sidebar_content_type') == 'quote'): ?>
              <blockquote class="c-quote">
                <?php while( have_rows('quote') ): the_row(); ?>
                  <div class="o-icon c-icon-quote c-quote__icon--event"></div>
                  <h4 class="c-quote__text"><?php the_sub_field('text'); ?></h4>
                  <div class="c-quote__meta">
                    <span>—</span>
                    <span class="c-quote__author"><?php the_sub_field('author'); ?><span>, </span></span>
                    <span class="c-quote__source"><?php the_sub_field('source'); ?></span>
                  </div>
                <?php endwhile; ?>
              </blockquote>
            <?php endif; ?>

            <?php if(get_sub_field('sidebar_content_type') == 'sidenote'): ?>
              <div class="c-sidebar-sidenote">
                <?php while( have_rows('sidenote') ): the_row(); ?>
                  <div class="c-sidenote">
                    <h4 class="c-sidenote-title"><?php the_sub_field('title'); ?></h4>
                    <p class="c-sidenote__caption"><?php the_sub_field('caption'); ?></p>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>


          </div> <!-- sidebar_content -->
        <?php endwhile; ?>
      <?php endif; ?>

    </div>

    <div class="c-footnotes">

      <?php if(get_field('sources')): ?>
        <div class="c-footnotes__column">
          <h4 class="c-footnotes__title"><?php the_field('event_sources_title', 'option'); ?></h4>
            <ol class="c-footnotes__list">

            <?php while( have_rows('sources') ): the_row(); ?>

                <li class="c-footnotes__item">

                  <?php if( get_sub_field('author') ): ?>
                    <?php while( have_rows('author') ): the_row(); ?>
                      <?php the_sub_field('first_name'); ?>
                      <?php the_sub_field('last_name'); ?>,
                    <?php endwhile; ?>
                  <?php endif; ?>

                  <?php if (get_sub_field('title')): ?>
                    <?php the_sub_field('title'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('chapter')): ?>
                    <?php the_sub_field('chapter'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('url')): ?>
                    (<a href="<?php the_sub_field('url'); ?>">
                      <?php the_sub_field('url'); ?>
                    </a>)
                  <?php endif; ?>

                  <?php if( get_sub_field('editor') ): ?>
                    <?php the_field('event_source_editors_title', 'option'); ?>
                    <?php while( have_rows('editor') ): the_row(); ?>
                      <?php the_sub_field('first_name'); ?>
                      <?php the_sub_field('last_name'); ?>,
                    <?php endwhile; ?>
                  <?php endif; ?>

                  <?php if( get_sub_field('translator') ): ?>
                    <?php the_field('event_source_translators_title', 'option'); ?>
                    <?php while( have_rows('translator') ): the_row(); ?>
                      <?php the_sub_field('first_name'); ?>
                      <?php the_sub_field('last_name'); ?>,
                    <?php endwhile; ?>
                  <?php endif; ?>

                  <?php if (get_sub_field('periodical_title')): ?>
                    <?php the_sub_field('periodical_title'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('website_name')): ?>
                    <?php the_sub_field('website_name'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('location')): ?>
                    <?php the_sub_field('location'); ?>,
                  <?php endif; ?>

                  <?php if (get_sub_field('publisher')): ?>
                    <?php the_sub_field('publisher'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('pages')): ?>
                    <?php the_field('event_source_pages_title', 'option'); ?>:
                    <?php the_sub_field('pages'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('volume')): ?>
                    <?php the_field('event_source_volume_title', 'option'); ?>:
                    <?php the_sub_field('volume'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('edition')): ?>
                    <?php the_field('event_source_edition_title', 'option'); ?>:
                    <?php the_sub_field('edition'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('isbn')): ?>
                    <?php the_sub_field('isbn'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('year_published')): ?>
                    <?php the_sub_field('year_published'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('date_published')): ?>
                    <?php the_sub_field('date_published'); ?>.
                  <?php endif; ?>

                  <?php if( get_sub_field('date_accessed') ): ?>
                    <?php the_field('event_date_accessed_title', 'option'); ?>:
                    <?php the_sub_field('date_accessed'); ?>.
                  <?php endif; ?>

                </li>

            <?php endwhile; ?>
          </ol>
        </div>
      <?php endif; ?>

      <?php if(get_field('resources')): ?>
        <div class="c-footnotes__column">
          <h4 class="c-footnotes__title"><?php the_field('event_resources_title', 'option'); ?></h4>
            <ol class="c-footnotes__list">

            <?php while( have_rows('resources') ): the_row(); ?>

                <li class="c-footnotes__item">

                  <?php if( get_sub_field('author') ): ?>
                    <?php while( have_rows('author') ): the_row(); ?>
                      <?php the_sub_field('first_name'); ?>
                      <?php the_sub_field('last_name'); ?>,
                    <?php endwhile; ?>
                  <?php endif; ?>

                  <?php if (get_sub_field('title')): ?>
                    <?php the_sub_field('title'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('chapter')): ?>
                    <?php the_sub_field('chapter'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('url')): ?>
                    (<a href="<?php the_sub_field('url'); ?>">
                      <?php the_sub_field('url'); ?>
                    </a>)
                  <?php endif; ?>

                  <?php if(get_sub_field('editor')): ?>
                    <?php the_field('event_source_editors_title', 'option'); ?>
                    <?php while(have_rows('editor')): the_row(); ?>
                      <?php the_sub_field('first_name'); ?>
                      <?php the_sub_field('last_name'); ?>,
                    <?php endwhile; ?>
                  <?php endif; ?>

                  <?php if(get_sub_field('translator')): ?>
                    <?php the_field('event_source_translators_title', 'option'); ?>
                    <?php while(have_rows('translator')): the_row(); ?>
                      <?php the_sub_field('first_name'); ?>
                      <?php the_sub_field('last_name'); ?>,
                    <?php endwhile; ?>
                  <?php endif; ?>

                  <?php if (get_sub_field('periodical_title')): ?>
                    <?php the_sub_field('periodical_title'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('website_name')): ?>
                    <?php the_sub_field('website_name'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('location')): ?>
                    <?php the_sub_field('location'); ?>,
                  <?php endif; ?>

                  <?php if (get_sub_field('publisher')): ?>
                    <?php the_sub_field('publisher'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('pages')): ?>
                    <?php the_field('event_source_pages_title', 'option'); ?>:
                    <?php the_sub_field('pages'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('volume')): ?>
                    <?php the_field('event_source_volume_title', 'option'); ?>:
                    <?php the_sub_field('volume'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('edition')): ?>
                    <?php the_field('event_source_edition_title', 'option'); ?>:
                    <?php the_sub_field('edition'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('isbn')): ?>
                    <?php the_sub_field('isbn'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('year_published')): ?>
                    <?php the_sub_field('year_published'); ?>.
                  <?php endif; ?>

                  <?php if (get_sub_field('date_published')): ?>
                    <?php the_sub_field('date_published'); ?>.
                  <?php endif; ?>

                  <?php if(get_sub_field('date_accessed')): ?>
                    <?php the_field('event_date_accessed_title', 'option'); ?>:
                    <?php the_sub_field('date_accessed'); ?>.
                  <?php endif; ?>

                </li>

            <?php endwhile; ?>
          </ol>
        </div>
      <?php endif; ?>

    </div>
  </article>
<?php endwhile; ?>
