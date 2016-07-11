<?php namespace ReBe\API\Data;

use ReBe\API\PostDataFilter;

/**
 * Workshop post type data
 *
 * @return   array
 * @uses     ReBe\API\PostDataFilter
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
*/
class Workshop
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
            'app_base'                   => get_field('workshop_post_type_slug', 'option'),
            'preview_image'              => wp_get_attachment_url(get_post_thumbnail_id($this->post->ID)),
            'caption'                    => $this->post->caption,

            'target_group'               => $this->post->target_group,
            'group_size'                 => $this->post->group_size,
            'duration'                   => $this->post->duration,

            'types'                        => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'workshop_type')),
            'languages'                   => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'workshop_language')),

        ];

        return $data;

    }

    public function full() {

        $data = [

            // Basic data
            'id'                         => $this->post->ID,
            'title'                      => $this->post->post_title,
            'published_date_gmt'         => $this->post->post_date_gmt,
            'slug'                       => $this->post->post_name,
            'app_base'                   => get_field('workshop_post_type_slug', 'option'),
            'preview_image'              => wp_get_attachment_url(get_post_thumbnail_id($this->post->ID)),

            'target_group'               => $this->post->target_group,
            'group_size'                 => $this->post->group_size,
            'duration'                   => $this->post->duration,

            // Taxonomy terms
            'types'                      => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'workshop_type')),
            'languages'                  => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'workshop_language')),
            'topics'                     => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'workshop_topic')),
            'groups'                     => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'workshop_group')),
            'tags'                       => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'global_tag')),

            // Short preview text
            'caption'                    => $this->post->caption,

            // Related posts
            'related_workshops'          => $this->dataFilter->post_related(get_field('related_workshops', $this->post->ID), 'workshop'),
            'related_stories'            => $this->dataFilter->post_related(get_field('related_stories', $this->post->ID), 'story'),
            'related_events'             => $this->dataFilter->post_related(get_field('related_events', $this->post->ID), 'event'),

            // Content
            'lead_text'                  => get_field('lead_text', $this->post->ID),
            'main_text'                  => get_field('main_text', $this->post->ID),
            'sidebar'                    => $this->dataFilter->post_sidebar(get_field('sidebar_content', $this->post->ID)),

            ];

        return $data;

    }
}
