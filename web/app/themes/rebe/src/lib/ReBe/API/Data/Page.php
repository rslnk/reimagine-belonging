<?php namespace ReBe\API\Data;

use ReBe\API\PostDataFilter;

/**
 * Page post type data
 *
 * @return   array
 * @uses     ReBe\API\PostDataFilter
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
*/
class Page
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
            'slug'                       => $this->post->post_name,
            'published_date_gmt'         => $this->post->post_date_gmt,

        ];

        return $data;

    }

    public function full() {

        $data = [

            // Basic data
            'id'                         => $this->post->ID,
            'title'                      => $this->post->post_title,
            'slug'                       => $this->post->post_name,
            'permalink'                  => get_permalink($this->post->ID),
            'published_date_gmt'         => $this->post->post_date_gmt,

            // Content
            'lead_text'                  => get_field('lead_text', $this->post->ID),
            'main_text'                  => get_field('main_text', $this->post->ID),
            'sidebar'                    => $this->dataFilter->post_sidebar(get_field('sidebar_content', $this->post->ID)),

            ];

        return $data;

    }
}
