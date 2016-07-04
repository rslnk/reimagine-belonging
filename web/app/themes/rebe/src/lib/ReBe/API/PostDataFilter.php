<?php namespace ReBe\API;

use ReBe\API\Data\Event;
use ReBe\API\Data\Story;
use ReBe\API\Data\Workshop;
use ReBe\API\Data\Page;

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
        else if(!empty($posts) && $post_type == 'workshop'){
            foreach ($posts as $post) {
                $workshop_preview = new Workshop($post);
                $result[] = $workshop_preview->teaser();
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

                case 'video':
                    $i                       = $item['video'][0];
                    $i['type']               = 'video';
                    $i['video_id']           = $i['id']; // legacy support
                    $result[]                = $i;
                    break;

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
                    $i['slug']               = $post->post_name;
                    $i['app_base']           = get_field('event_post_type_slug', 'option');
                    $i['start_date']         = $post->start_date;
                    $i['preview_image']      = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    $i['type']               = 'event';
                    $result[]                = $i;
                    break;

                case 'story':
                    $i                       = [];
                    $post                    = $item['featured_story'][0];

                    $i['title']              = $post->post_title;
                    $i['slug']               = $post->post_name;
                    $i['app_base']           = get_field('story_post_type_slug', 'option');
                    $i['hero']               = self::post_taxonomy(get_the_terms($post->ID, 'story_person'));
                    $i['cities']             = self::post_taxonomy(get_the_terms($post->ID, 'story_city'));
                    $i['excerpt']            = $post->excerpt;
                    $i['video_url']          = $post->video_url;
                    $i['video_host']         = $post->story_video_host; // legacy support
                    $i['video_id']           = $post->story_video_id; // legacy support
                    $i['preview_image']      = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
                    $i['type']               = 'story';
                    $result[]                = $i;
                    break;

                case 'workshop':
                    $i                       = [];
                    $post                    = $item['featured_workshop'][0];

                    $i['title']              = $post->post_title;
                    $i['slug']               = $post->post_name;
                    $i['app_base']           = get_field('workshop_post_type_slug', 'option');
                    $i['caption']            = $post->caption;
                    $i['target_group']       = $post->target_group;
                    $i['group_size']         = $post->group_size;
                    $i['duration']           = $post->duration;
                    $i['types']              = self::post_taxonomy(get_the_terms($post->ID, 'workshop_type'));
                    $i['type']               = 'workshop';
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
