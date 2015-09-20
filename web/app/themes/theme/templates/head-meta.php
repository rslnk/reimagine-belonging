<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" href="<?php echo get_template_directory_uri() ?>/dist/images/meta/favicon-32.png" type="image/x-icon">

<?php if(get_field('google­site­verification_id', 'option')): ?>
  <meta name="google-site-verification" content="<?php the_field('google­site­verification_id', 'option'); ?>">
<?php endif; ?>

<meta name="description" content="<?php
  // for the event post
  if(is_single() && get_field('subtitle')): the_field('subtitle');
  // for the story post
  elseif(is_single() && get_field('excerpt')): the_field('subtitle');
  // for everything else
  else: the_field('meta_description_default', 'option');
  endif;
?>" />

<!-- Facebook meta for OpenGraph -->
<meta property="og:type" content="<?php
  if (is_single()): echo 'article';
  else: echo 'website';
  endif;
?>" />
<meta property="og:site_name" content="<?= the_field('meta_site_name', 'option'); ?>" />
<meta property="og:title" content="<?php
  $subtitle = get_field('subtitle');
  if(is_front_page()): the_field('meta_title_default', 'option');
  elseif(is_singular() && is_page()): echo (strip_tags($subtitle));
  else: the_title();
  endif;
?>"/>
<meta property="og:url" content="<?php
  if(is_front_page()): echo home_url();
  else: the_permalink();
  endif;
?>" />
<meta property="og:image" content="<?php
  // check if post has thumbnail
  if(has_post_thumbnail($post->ID)): echo wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ));
  // for everything else use default image that should be set from WP admin
  // attach site url in order to show non-relative image path
  else: bloginfo('url') . the_field('meta_image_default', 'option');
  endif;
?>"/>
<meta property="og:description" content="<?php
  // for the event post
  if(is_single() && get_field('subtitle')): the_field('subtitle');
  // for the story post
  elseif(is_single() && get_field('excerpt')): the_field('subtitle');
  // for everything else
  else: the_field('meta_description_default', 'option');
  endif;
?>" />
<meta property="og:locale" content="<?php the_field('site_language', 'option') ?>" />
<meta property="og:locale:alternate" content="<?php the_field('site_language_alt', "option") ?>" />
<?php if(get_field('facebook_user_id', 'option')): ?>
  <meta property="fb:admins" content="<?php the_field('facebook_user_id', 'option') ?>" />
<?php endif;?>
<?php if(get_field('facebook_app_id', 'option')): ?>
  <meta property="fb:app_id" content="<?php the_field('facebook_app_id', 'option') ?>" />
<?php endif;?>
<?php if(get_field('facebook_page_id', 'option')): ?>
  <meta property="fb:page_id" content="<?php the_field('facebook_page_id', 'option') ?>" />
<?php endif;?>

<!-- Twitter Summary Card with Large Image -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:site" content="@<?php the_field('twitter_handle', 'option') ?>" />
<meta name="twitter:title" content="<?php
  $subtitle = get_field('subtitle');
  if(is_front_page()): the_field('meta_title_default', 'option');
  elseif(is_singular() && is_page()): echo (strip_tags($subtitle));
  else: the_title();
  endif;
?>"/>
<meta name="twitter:description" content="<?php
  // for the event post
  if(is_single() && get_field('subtitle')): the_field('subtitle');
  // for the story post
  elseif(is_single() && get_field('excerpt')): the_field('subtitle');
  // for everything else
  else: the_field('meta_description_default', 'option');
  endif;
?>" />
<meta name="twitter:image" content="<?php
  // check if post has thumbnail
  if(has_post_thumbnail($post->ID)): echo wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ));
  // for everything else use default image that should be set from WP admin
  // attach site url in order to show non-relative image path
  else: bloginfo('url') . the_field('meta_image_default', 'option');
  endif;
?>"/>
