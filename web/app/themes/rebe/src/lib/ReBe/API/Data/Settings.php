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

            // Global
            'site_language'       => get_field('site_language', 'option'),
            'site_date_format'    => get_field('site_date_format', 'option'),

            // Services
            'google_analytics_id' => get_field('google_analytics_id', 'option'),
            'facebook_app_id'     => get_field('facebook_app_id', 'option'),
            'facebook_admin_id'   => get_field('facebook_admin_id', 'option'),
            'facebook_user_id'    => get_field('facebook_user_id', 'option'),
            'facebook_user_name'  => get_field('facebook_user_name', 'option'),
            'twitter_user_name'   => get_field('twitter_user_name', 'option'),
            'vimeo_user_name'     => get_field('vimeo_user_name', 'option'),
            'social_hashtags'     => get_field('social_hashtags', 'option'),

            // Events app
            'timelines'           => get_field('public_timelines', 'option'),
            'default_timeline'    => get_field('default_timeline', 'option'),
            'event_filters'       => get_field('event_filters', 'option'),

            // Stories app
            'story_filters'       => get_field('story_filters', 'option'),

            // Workshops app
            'workshop_external_form_url'    => get_field('workshop_external_form_url', 'option'),

            // Advanced srttings
            'events_slug'                   => get_field('event_post_type_slug', 'option'),
            'stories_slug'                  => get_field('story_post_type_slug', 'option'),
            'workshops_slug'                => get_field('workshop_post_type_slug', 'option'),

        ];

        return $data;
    }

}
