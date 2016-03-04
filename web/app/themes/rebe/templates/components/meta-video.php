<?php
  /*

  # Story post type video meta

  Show these meta tags if post type is 'story' and post format is video.

  */
?>

<?php
  // Get story video url
  if(get_field('story_video_host', $post->ID) == 'yotube') {
    $video_host = 'https://youtu.be/';
  }
  else if(get_field('story_video_host', $post->ID) == 'vimeo') {
    $video_host = 'https://vimeo.com/';
  }
  else {
    $video_host = false;
  }
  $video_id = get_field('story_video_id', $post->ID);
  $video_url = $video_host . $video_id;
?>

<meta property="og:type" content="<?php echo 'video.other'; ?>" />
<meta property="og:video" content="<?php echo $video_url; ?>" />

<meta name="twitter:card" content="player" />
<meta name="twitter:player" content="<?php echo $video_url; ?>" />
<meta name="twitter:player:width" content="360" />
<meta name="twitter:player:height" content="200" />
