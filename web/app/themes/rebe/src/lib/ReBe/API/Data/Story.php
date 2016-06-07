<?php namespace ReBe\API\Data;

use ReBe\API\PostDataFilter;

/**
 * Story post type data
 *
 * @return   array
 * @uses     ReBe\API\PostDataFilter
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
*/
class Story
{
    protected $post;
    protected $dataFilter;

    public function __construct($post_id) {

        $this->post = $post_id;

        $dataFilter       = new PostDataFilter();
        $this->dataFilter = $dataFilter;

    }

    public function teaser() {

        $data = [

            'id'                         => $this->post->ID,
            'title'                      => $this->post->post_title,
            'published_date_gmt'         => $this->post->post_date_gmt,
            'slug'                       => $this->post->post_name,
            'app_base'                   => get_field('story_post_type_slug', 'option'),
            'permalink'                  => get_permalink($this->post->ID),
            'preview_image'              => wp_get_attachment_url(get_post_thumbnail_id($this->post->ID)),
            'preview_image_color'        => $this->post->color,

            'format'                     => get_post_format($this->post->ID),

            'hero'                       => $this->post->protagonist_name,
            'cities'                     => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_city')),
            'topics'                     => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_topic')),
            'people'                     => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_person')),

        ];

        return $data;

    }

    public function full() {

        $data = [

            // Basic data
            'id'                            => $this->post->ID,
            'title'                         => $this->post->post_title,
            'published_date_gmt'            => $this->post->post_date_gmt,
            'slug'                          => $this->post->post_name,
            'permalink'                     => get_permalink($this->post->ID),
            'preview_image'                 => wp_get_attachment_url(get_post_thumbnail_id($this->post->ID)),
            'preview_image_color'           => $this->post->color,

            'format'                        => get_post_format($this->post->ID),

            'hero'                          => $this->post->protagonist_name,
            'excerpt'                       => $this->post->excerpt,

            // Taxonomy terms
            'groups'                        => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_group')),
            'topics'                        => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_topic')),
            'cities'                        => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_city')),
            'people'                        => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'story_person')),
            'tags'                          => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'global_tag')),

            // Content: video (default)
            'story_video_host'              => $this->post->story_video_host,
            'story_video_id'                => $this->post->story_video_id,
            'story_oembed_video'            => $this->post->story_oembed_video,
            'subtitles_notification'        => $this->post->subtitles_notification,

            // Content: audio
            'story_oembed_audio'            => $this->post->story_oembed_audio,

            // Content: standart (text)
            'story_text'                    => get_field('text', $this->post->ID),

            // Related posts
            'related_stories'               => $this->dataFilter->post_related(get_field('related_stories', $this->post->ID), 'story'),
            'related_events'                => $this->dataFilter->post_related(get_field('related_events', $this->post->ID), 'event'),

            ];

        return $data;

    }
}
