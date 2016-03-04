<?php while (have_posts()) : the_post(); ?>
  <article class="o-wrapper">
    <header class="c-event__header">

      <?= App\list_categories(); ?>

      <h1 class="o-heading c-heading--event-title"><?php the_title(); ?></h1>
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
      <ul class="o-social-icons o-social-icons__list c-social-icons__list--post-share">
        <li class="o-social-icons__item">
          <a class="o-icons-list__link c-icons-list__link--post-share o-icon c-icon-facebook" target="_blank" href="http://www.facebook.com/sharer/sharer.php?u={{ shareUrl }}">Facebook Share</a>
        </li>
        <li class="o-social-icons__item">
          <a class="o-icons-list__link c-icons-list__link--post-share o-icon c-icon-twitter" href="http://www.twitter.com/share?url={{ shareUrl }}">Tweet</a>
        </li>
      </ul>
    </header>
    <div class="o-row">

      <div class="c-event__body c-event__content o-wp-editor">
        <?php the_field('main_content'); ?>
      </div>

      <?php if(get_field('sidebar_content')): ?>
        <?php while( have_rows('sidebar_content') ): the_row(); ?>
          <div class="c-event__sidebar">

            <?php if(get_sub_field('sidebar_content_type') == 'video'): ?>
              <div class="c-sidebar-video">
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
                  <h4 class="o-heading c-sidebar-video__title"><?php the_sub_field('title'); ?></h4>
                  <p class="o-paragraph c-paragraph--sidebar c-sidebar-video__caption"><?php the_sub_field('caption'); ?></p>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

            <?php if(get_sub_field('sidebar_content_type') == 'image'): ?>
              <div class="c-sidebar-image">
                <?php while( have_rows('image') ): the_row(); ?>
                  <?php if(get_sub_field('url')): ?>
                    <div class="u-image-container u-image-ratio--4x3 c-sidebar-image__item" style="background-image: url(<?php the_sub_field('url'); ?>)"></div>
                  <?php endif; ?>

                  <?php if (get_sub_field('credit')): ?>
                    <a class="c-media-credits" href="<?php the_sub_field('credit_link'); ?>">
                      <?php the_sub_field('credit'); ?>
                    </a>
                  <?php endif; ?>
                  <h4 class="o-heading c-sidebar-image__title"><?php the_sub_field('title'); ?></h4>
                  <p class="o-paragraph c-paragraph--sidebar c-sidebar-image__caption"><?php the_sub_field('caption'); ?></p>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

            <?php if(get_sub_field('sidebar_content_type') == 'quote'): ?>
              <div class="c-sidebar-quote">
                <?php while( have_rows('quote') ): the_row(); ?>
                  <div class="o-icon c-icon-quotation-mark-mint c-sidebar-quote__icon"></div>
                  <h4 class="o-heading c-sidebar-quote__text"><?php the_sub_field('text'); ?></h4>
                  <div class="c-sidebar-quote__author-block">
                    <span class="c-sidebar-quote__dash">—</span>
                    <span class="c-sidebar-quote__author"><?php the_sub_field('author'); ?><span>, </span></span>
                    <span class="c-sidebar-quote__source"><?php the_sub_field('source'); ?></span>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>

            <?php if(get_sub_field('sidebar_content_type') == 'sidenote'): ?>
              <div class="c-sidebar-sidenote">
                <?php while( have_rows('sidenote') ): the_row(); ?>
                  <div class="c-sidebar-note">
                    <h4 class="o-heading c-sidebar-note__text c-sidebar-note__text--event"><?php the_sub_field('title'); ?></h4>
                    <p class="o-paragraph c-paragraph--sidebar c-sidebar-note__caption"><?php the_sub_field('caption'); ?></p>
                  </div>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>


          </div> <!-- sidebar_content -->
        <?php endwhile; ?>
      <?php endif; ?>

    </div>

    <div class="o-row">

      <?php if(get_field('sources')): ?>
        <div class="o-footnotes c-footnotes--sources">
          <h4 class="o-heading c-heading--section-title"><?php the_field('event_sources_title', 'option'); ?></h4>
            <ol class="o-list o-list--decimal c-footnotes__list">

            <?php while( have_rows('sources') ): the_row(); ?>

                <li class="c-footnotes__list-item">

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

      <?php if(get_field('sources')): ?>
        <div class="o-footnotes c-footnotes--resources">
          <h4 class="o-heading c-heading--section-title"><?php the_field('event_resources_title', 'option'); ?></h4>
            <ol class="o-list o-list--decimal c-footnotes__list">

            <?php while( have_rows('resources') ): the_row(); ?>

                <li class="c-footnotes__list-item">

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
