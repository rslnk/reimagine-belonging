<?php namespace ReBe\API\Data;

/**
 * Site global configuration settings
 *
 * @return   array
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
 *
*/
class Settings
{
    public static function site_settings() {

        $data = [

            // Basic
            'site_date_format'    => get_field('site_date_format', 'option'),
            'site_language'       => get_field('site_language', 'option'),
            'google_analytics_id' => get_field('google_analytics_id', 'option'),
            'facebook_app_id'     => get_field('facebook_app_id', 'option'),
            'twitter_handle'      => get_field('twitter_handle', 'option'),

            // Timeline
            'timelines'           => get_field('public_timelines', 'option'),
            'default_timeline'    => get_field('default_timeline', 'option'),

            // Filters
            'event_filters'       => get_field('event_filters', 'option'),
            'story_filters'       => get_field('story_filters', 'option'),

        ];

        return $data;
    }

}
