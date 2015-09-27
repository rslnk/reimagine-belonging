<?php
/*

  # Output Site configuration

  Output data set in WordPress Site Settings option pages fields
  http://www.advancedcustomfields.com/resources/get-values-from-an-options-page

*/

namespace BaseSetup\API\Data;

function siteConfiguration() {


  $output = [

    // Site settings
    'site_date_format'                       => get_field('site_date_format', 'option'),
    'site_language'                          => get_field('site_language', 'option'),
    'google_analytics_id'                    => get_field('google_analytics_id', 'option'),
    'facebook_app_id'                        => get_field('facebook_app_id', 'option'),
    'twitter_handle'                         => get_field('twitter_handle', 'option'),

    // Timeline settings
    'timelines'                              => get_field('public_timelines', 'option'),
    'default_timeline'                       => get_field('default_timeline', 'option'),

    // Dictionary (UI elemets text & labels)

    // Stories
    'add_story_banner_text'                  => get_field('stories_add_story_banner_text', 'option'),
    'all_stories_filter_label'               => get_field('all_stories_filter_label', 'option'),
    'total_stories_label'                    => get_field('total_stories_label', 'option'),
    'flitered_stories_label'                 => get_field('flitered_stories_label', 'option'),
    'stories_load_more_label'                => get_field('stories_load_more_label', 'option'),
    'stories_search_result_none_message'     => get_field('stories_search_result_none_message', 'option'),
    'story_cc_notice_title'                  => get_field('story_cc_notice_title', 'option'),
    'story_cc_notice_text'                   => get_field('story_cc_notice_text', 'option'),

    // Timeline
    'timeline_info_banner_text'              => get_field('timeline_info_banner_text', 'option'),
    'all_events_filter_label'                => get_field('timeline_all_events_filter_label', 'option'),
    'timeline_total_events_label'            => get_field('timeline_total_events_label', 'option'),
    'timeline_filtered_events_label'         => get_field('timeline_filtered_events_label', 'option'),
    'timeline_search_result_none_message'    => get_field('timeline_search_result_none_message', 'option'),

    // Events and stories filters
    'event_filters'                          => get_field('event_filters', 'option'),
    'story_filters'                          => get_field('story_filters', 'option'),

    // Story
    'story_share_story_label'                => get_field('story_share_story_label', 'option'),
    'story_related_stories_title'            => get_field('story_related_stories_title', 'option'),
    'story_related_events_title'             => get_field('story_related_events_title', 'option'),

    // Event
    'event_impact_counter_label'             => get_field('event_impact_counter_label', 'option'),
    'event_impact_button_default_label'      => get_field('event_impact_button_default_label', 'option'),
    'event_impact_button_active_label'       => get_field('event_impact_button_active_label', 'option'),

    'event_related_stories_title'            => get_field('event_related_stories_title', 'option'),
    'event_related_events_title'             => get_field('event_related_events_title', 'option'),

    'event_sources_title'                    => get_field('event_sources_title', 'option'),
    'event_resources_title'                  => get_field('event_resources_title', 'option'),
    'event_source_editors'                   => get_field('event_source_editors_title', 'option'),
    'event_source_translators'               => get_field('event_source_translators_title', 'option'),
    'event_source_edition'                   => get_field('event_source_edition_title', 'option'),
    'event_source_volume'                    => get_field('event_source_volume_title', 'option'),
    'event_source_pages'                     => get_field('event_source_pages_title', 'option'),
    'event_source_date_accessed'             => get_field('event_date_accessed_title', 'option'),
    'event_add_resource_button_label'        => get_field('event_suggest_resource_button_label', 'option'),

    // Common
    'toggle_navigation_button_label'         => get_field('toggle_navigation_button_screen_text', 'option'),
    'contact_us_button_label'                => get_field('contact_us_button_label', 'option'),
    'search_label'                           => get_field('search_label', 'option'),
    'close_button_label'                     => get_field('close_button_label', 'option'),
    'next_button_label'                      => get_field('next_button_label', 'option'),
    'previous_button_label'                  => get_field('previous_button_label', 'option'),

  ];

  return $output;

}
