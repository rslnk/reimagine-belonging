<?php namespace ReBe\API\Data;

/**
 * Dictionary terms for UI elemets text & labels
 *
 * @return   array
 * @uses     ACF PRO ^5.0
 * @link     http://www.advancedcustomfields.com/resources/get-values-from-an-options-page
*/
class Dictionary
{

    public static function site_dictionary()
    {
        $data = [

            // Stories page
            'stories_page_title'                     => get_field('stories_page_title', 'option'),
            'add_story_banner_text'                  => get_field('stories_add_story_banner_text', 'option'),
            'all_stories_filter_label'               => get_field('all_stories_filter_label', 'option'),
            'total_stories_label'                    => get_field('total_stories_label', 'option'),
            'flitered_stories_label'                 => get_field('flitered_stories_label', 'option'),
            'stories_load_more_label'                => get_field('stories_load_more_label', 'option'),
            'stories_search_result_none_message'     => get_field('stories_search_result_none_message', 'option'),

            // Story post
            'story_cc_notice_title'                  => get_field('story_cc_notice_title', 'option'),
            'story_cc_notice_text'                   => get_field('story_cc_notice_text', 'option'),
            'share_story_label'                      => get_field('share_story_label', 'option'),
            'story_related_stories_title'            => get_field('story_related_stories_title', 'option'),
            'story_related_events_title'             => get_field('story_related_events_title', 'option'),

            // Events page (Timeline)
            'events_page_title'                      => get_field('events_page_title', 'option'),
            'timeline_info_banner_text'              => get_field('timeline_info_banner_text', 'option'),
            'all_events_filter_label'                => get_field('timeline_all_events_filter_label', 'option'),
            'timeline_total_events_label'            => get_field('timeline_total_events_label', 'option'),
            'timeline_filtered_events_label'         => get_field('timeline_filtered_events_label', 'option'),
            'timeline_search_result_none_message'    => get_field('timeline_search_result_none_message', 'option'),

            // Event post
            'event_impact_counter_label'             => get_field('event_impact_counter_label', 'option'),
            'event_impact_button_default_label'      => get_field('event_impact_button_default_label', 'option'),
            'event_impact_button_active_label'       => get_field('event_impact_button_active_label', 'option'),
            'share_event_label'                      => get_field('share_event_label', 'option'),
            'event_related_stories_title'            => get_field('event_related_stories_title', 'option'),
            'event_related_events_title'             => get_field('event_related_events_title', 'option'),
            'event_featured_story_title'             => get_field('event_featured_story_title', 'option'),
            'event_featured_workshop_title'          => get_field('event_featured_workshop_title', 'option'),
            'event_sources_title'                    => get_field('event_sources_title', 'option'),
            'event_resources_title'                  => get_field('event_resources_title', 'option'),
            'event_source_editors'                   => get_field('event_source_editors_title', 'option'),
            'event_source_translators'               => get_field('event_source_translators_title', 'option'),
            'event_source_edition'                   => get_field('event_source_edition_title', 'option'),
            'event_source_volume'                    => get_field('event_source_volume_title', 'option'),
            'event_source_pages'                     => get_field('event_source_pages_title', 'option'),
            'event_source_date_accessed'             => get_field('event_date_accessed_title', 'option'),
            'event_add_resource_button_label'        => get_field('event_suggest_resource_button_label', 'option'),

            // Workshops page
            'workshops_page_title'                   => get_field('workshops_page_title', 'option'),
            'featured_workshops_label'               => get_field('featured_workshops_label', 'option'),
            'total_workshops_label'                  => get_field('total_workshops_label', 'option'),

            // Workshop post
            'workshop_target_group_label'            => get_field('workshop_target_group_label', 'option'),
            'workshop_group_size_label'              => get_field('workshop_group_size_label', 'option'),
            'workshop_duration_label'                => get_field('workshop_duration_label', 'option'),
            'workshop_location_label'                => get_field('workshop_location_label', 'option'),
            'workshop_language_label'                => get_field('workshop_language_label', 'option'),
            'workshop_type_label'                    => get_field('workshop_type_label', 'option'),
            'workshop_topic_label'                   => get_field('workshop_topic_label', 'option'),
            'workshop_preview_cta_button_label'      => get_field('workshop_preview_cta_button_label', 'option'),
            'workshop_booking_button_label'          => get_field('workshop_booking_button_label', 'option'),
            'workshop_related_workshops_label'       => get_field('workshop_related_workshops_label', 'option'),

            // UI & Accessability
            'toggle_navigation_button_screen_text'   => get_field('toggle_navigation_button_screen_text', 'option'),
            'newsletter_sign_up_button_label'        => get_field('newsletter_sign_up_button_label', 'option'),
            'contact_us_button_label'                => get_field('contact_us_button_label', 'option'),
            'search_label'                           => get_field('search_label', 'option'),
            'pagination_page_label'                  => get_field('pagination_page_label', 'option'),
            'close_button_label'                     => get_field('close_button_label', 'option'),
            'next_button_label'                      => get_field('next_button_label', 'option'),
            'previous_button_label'                  => get_field('previous_button_label', 'option'),
            'follow_label'                           => get_field('follow_label', 'option'),
            'share_label'                            => get_field('share_label', 'option'),

        ];

        return $data;
    }
}
