<?php namespace ReBe\API;

use ReBe\API\Data\Event;
use ReBe\API\Data\Story;

/**
 * Filter object's data for cleaner API output
 *
 * @return   mixed
 * @uses     WP_Query
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
*/
class PostDataFilter
{

    /**
    * Get post's related posts
    *
    * @param    array       $posts
    * @param    string      $post_type
    * @return   array
    */
    public static function post_related($posts, $post_type) {

        $result = [];

        if (!empty($posts) && $post_type == 'event') {
            foreach ($posts as $post) {
                $event_preview = new Event($post);
                $result[] = $event_preview->teaser();
            }
            return $result;
        }
        else if(!empty($posts) && $post_type == 'story'){
            foreach ($posts as $post) {
                $story_preview = new Story($post);
                $result[] = $story_preview->teaser();
            }
            return $result;
        }
    }

    /**
    * Get post's taxonomy terms
    *
    * @param    array      $terms
    * @return   array
    */
    public static function post_taxonomy($terms) {
        $result = [];
        if (!empty($terms)) {
            foreach ($terms as $term) {
                $result[] = [
                    'term_name'  => $term->name,
                    'term_slug'  => $term->slug,
                    'term_color' => get_field('taxonomy_term_color',  $term),
                ];
            }
            return $result;
        }
    }

    /**
    * Get post's sidebar content
    *
    * @param    string      $content
    * @return   array
    */
    public static function post_sidebar($content) {
        $result = [];

        foreach ($content as $item) {

            switch ($item['sidebar_content_type']) {

                case 'image':
                    $i                       = $item['image'][0];
                    $i['type']               = 'image';
                    $result[]                = $i;
                    break;

                case 'quote':
                    $i                       = $item['quote'][0];
                    $i['type']               = 'quote';
                    $result[]                = $i;
                    break;

                case 'sidenote':
                    $i                       = $item['sidenote'][0];
                    $i['type']               = 'sidenote';
                    $result[]                = $i;
                    break;

                case 'event':
                    $i                       = [];
                    $post                    = $item['related_event'][0];

                    $i['title']              = $post->post_title;
                    $i['slug']               = get_permalink($post->ID);
                    $i['start_date']         = $post->start_date;
                    $i['preview_image']      = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    $i['type']               = 'event';
                    $result[]                = $i;
                    break;

                case 'story':
                    $i                       = [];
                    $post                    = $item['related_story'][0];

                    $i['title']              = $post->post_title;
                    $i['slug']               = get_permalink($post->ID);
                    $i['hero']               = $post->hero_name;
                    $i['hero_age']           = $post->hero_age;
                    $i['hero_city']          = $post->hero_city;
                    $i['preview_image']      = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    $i['type']               = 'story';
                    $result[]                = $i;
                    break;

                case 'video':
                    $i                       = $item['video'][0];
                    $i['type']               = 'video';
                    $result[]                = $i;
                    break;

              }
        }

        return $result;
    }

    /**
    * Get post's sources
    *
    * @param    string      $sources
    * @return   array
    */
    public static function post_sources($sources) {
        if (!$sources) {
            return null;
        }
        $result = [];
        foreach ($sources as $source) {
            $result[] = $source;
        }
        return $result;
    }

    /**
    * Get post's resources
    *
    * @param    string      $resources
    * @return   array
    */
    public static function post_resources($resources) {
        if (!$resources) {
            return null;
        }
        $result = [];
        foreach ($resources as $resource) {
            $result[] = $resource;
        }
        return $result;
    }

    /**
    * Get post's acf repeater subfields
    *
    * @link     http://www.advancedcustomfields.com/resources/get_fields
    * @param    string      $repeater
    * @return   array
    */
    public static function acf_repeater_subfields($repeater, $subfield) {
        // Check if repeater filed has subfields
        if (!empty(get_field($repeater))) {
            // Get all custom fields
            $custom_fields = get_fields($post->ID);
            // Get all repeater subfields
            $repeater = $custom_fields[$repeater];
            return $repeater . '[' . $subfield . ']';
        } else {
            $repeater = null;
            $subfield = null;
        }
    }
}
