<?php namespace ReBe\API\Data;

use ReBe\API\PostDataFilter;

/**
 * Event post type data
 *
 * @return   array
 * @uses     ReBe\API\PostDataFilter
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
*/
Class Event
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

            'id'                     => $this->post->ID,
            'title'                  => $this->post->post_title,
            'published_date_gmt'     => $this->post->post_date_gmt,
            'slug'                   => $this->post->post_name,
            'app_base'               => get_field('event_post_type_slug', 'option'),
            'permalink'              => get_permalink($this->post->ID),
            'preview_image'          => wp_get_attachment_url(get_post_thumbnail_id($this->post->ID)),

            'start_date'             => $this->post->start_date,

            'topics'                 => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_topic')),
            'timelines'              => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_timeline')),
            'eras'                   => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_era')),
            'groups'                 => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_group')),
            'topics'                 => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_topic')),

        ];

        return $data;
    }

    public function full() {

        $data = [

            // Basic data
            'id'                        => $this->post->ID,
            'title'                     => $this->post->post_title,
            'published_date_gmt'        => $this->post->post_date_gmt,
            'slug'                      => $this->post->post_name,
            'permalink'                 => get_permalink($this->post->ID),
            'preview_image'             => wp_get_attachment_url(get_post_thumbnail_id($this->post->ID)),

            'start_date'                => $this->post->start_date,
            'end_date'                  => $this->post->end_date,
            'exact_dates_uknown'        => $this->post->unknown_date,

            'authors'                   => $this->post->authors,

            // Taxonomy terms
            'timelines'                 => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_timeline')),
            'eras'                      => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_era')),
            'types'                     => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_type')),
            'groups'                    => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_group')),
            'topics'                    => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'event_topic')),
            'tags'                      => $this->dataFilter->post_taxonomy(get_the_terms($this->post->ID, 'global_tag')),

            // Header
            'display_header_image'           => $this->post->display_header_image,
            'header_image'                   => $this->dataFilter->acf_repeater_subfields('header_image', 'url'),
            'header_image_credit'            => $this->dataFilter->acf_repeater_subfields('header_image', 'credit'),
            'header_image_credit_link'       => $this->dataFilter->acf_repeater_subfields('header_image', 'credit_link'),
            'display_header_image_overlay'   => $this->dataFilter->acf_repeater_subfields('header_image', 'display_image_overlay'),
            'header_image_overlay_opacity'   => $this->dataFilter->acf_repeater_subfields('header_image', 'overlay_opacity'),

            // Content
            'lead_text'                      => get_field('lead_text', $this->post->ID),
            'main_content'                   => get_field('main_content', $this->post->ID),

            // Sidebar
            'sidebar'                        => $this->dataFilter->post_sidebar(get_field('sidebar_content', $this->post->ID)),

            // Footnotes
            'sources'                        => $this->dataFilter->post_sources(get_field('sources', $this->post->ID)),
            'resources'                      => $this->dataFilter->post_resources(get_field('resources', $this->post->ID)),

            // Related posts
            'related_stories'           => $this->dataFilter->post_related(get_field('related_stories', $this->post->ID), 'story'),
            'related_events'            => $this->dataFilter->post_related(get_field('related_events', $this->post->ID), 'event'),

        ];

        return $data;
    }

}
