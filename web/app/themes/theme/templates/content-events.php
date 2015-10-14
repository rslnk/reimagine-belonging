<?php use Theme\Lib\PostTypes; ?>

<?php

$the_query = new WP_Query([
	'post_type'			  => 'event',
	'posts_per_page'	=> -1,
	'meta_key'			  => 'start_date',
	'orderby'			    => 'meta_value_num',
	'order'				    => 'DESC'
]);

?>

<?php if( $the_query->have_posts() ): ?>

  <div class="o-row">
    <?php while( $the_query->have_posts() ): $the_query->the_post(); ?>

      <div class="u-image-container u-image-ratio--square story-preview__item" style="background-image: url(<?php echo wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>)">
        <div class="event-preview__image-overlay event-preview__image-overlay--gradient"></div>
        <div class="event-preview__image-overlay event-preview__image-overlay--solid"></div>
        <div class="event-preview__content">
          <?php
            // Get and format event year
            if( !empty(get_field('start_date', $post->ID)) ) {
              $date_row = get_field('start_date', $post->ID);
              $event_year = date("Y", strtotime($date_row));
            }
            else {
              $event_year = null;
            }
           ?>
          <div class="event-preview__year"><?php echo $event_year; ?></div>
          <div class="event-preview__title">

            <?php
              // Construct Event posts URL
              // Example: reimaginebelonging.org/<events-app-slug>/<timeline-slug>/<post-slug>/

              $event_post_timelines = wp_get_object_terms($post->ID, 'event_timeline');
              $timeline_slug        = $event_post_timelines[0]->slug;
              $timeline_name        = $event_post_timelines[0]->name;

              $site_url             = get_bloginfo('url');
              $event_post_slug      = PostTypes\GetEventPostTypeSlug();
              $event_post_name      = $post->post_name;

              $angular_app_permalink  = $site_url . '/' . $event_post_slug . '/' . $timeline_slug . '/' . $event_post_name . '/';
            ?>

            <h3 class="o-heading c-heading--story-preview">
              <?php echo $timeline_name . ':';?>
            </h3>
            <h2 class="o-heading c-heading--story-preview">
              <a href="<?php echo $angular_app_permalink;?>">
                <?php the_title(); ?>
              </a>
            </h2>
          </div>
        </div>
      </div>

      <?php wp_reset_postdata(); ?>
    <?php endwhile; ?>
  </div>
<?php endif; ?>
