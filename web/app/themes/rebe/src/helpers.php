<?php namespace App;

use Roots\Sage\Asset;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template;
use ReBe\Redirects\UserAgents;

function template($layout = 'base')
{
    return Template::$instances[$layout];
}

function template_part($template, array $context = [], $layout = 'base')
{
    extract($context);
    include template($layout)->partial($template);
}

/**
 * @param $filename
 * @return string
 */
function asset_path($filename)
{
    static $manifest;
    isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/assets.json');
    return (string) new Asset($filename, $manifest);
}

/**
 * Set <base> tag with URI href
 * @return string
 */
function set_template_uri_base()
{
    $parts = explode('/', rtrim($_SERVER['REQUEST_URI'], '/'));
    echo '<base href="/' . $parts[1] . '/"></base>';
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', true);
    return $display;
}

/**
 * Page titles
 * @return string
 */
function title()
{
    if (is_home()) {
        if ($home = get_option('page_for_posts', true)) {
            return get_the_title($home);
        }
        return __('Latest Posts', 'rebe');
    }
    if (is_archive()) {
        return get_the_archive_title();
    }
    if (is_search()) {
        return sprintf(__('Search Results for %s', 'rebe'), get_search_query());
    }
    if (is_404()) {
        return __('Not Found', 'rebe');
    }
    return get_the_title();
}

/**
*  Check if element is empty
* @param $element
* @return string
*/
function is_element_empty($element)
{
    $element = trim($element);
    return !empty($element);
}

/**
*  Check if logged in user has a role
* @param string $role, `administrator`, `editor` etc.
* @return string
*/
function is_user_role($role)
{
    $currentUser = wp_get_current_user();
    return in_array($role, $currentUser->roles);
}

/**
 * Get Google Analytics ID from Site settings
 * @return string
 */
function get_google_analytics_id()
{
    if (get_field('google_analytics_id', 'option')) {
        return get_field('google_analytics_id', 'option');
    }
}

/**
* Facebooks JavaScript SDK
* @return string
*/
function get_facebook_sdk()
{
    // Get Facebook App ID and site language values set via WordPress admin
    if (get_field('facebook_app_id', 'option')) {
        $app_id        = get_field('facebook_app_id', 'option');
        $site_language = get_field('site_language', 'option');
        echo '
        <script>
          window.fbAsyncInit = function() {
            FB.init({
              appId      : '. $app_id .',
              xfbml      : true,
              version    : \'v2.6\'
            });
          };

          (function(d, s, id){
             var js, fjs = d.getElementsByTagName(s)[0];
             if (d.getElementById(id)) {return;}
             js = d.createElement(s); js.id = id;
             js.src = "//connect.facebook.net/'. $site_language . '/sdk.js";
             fjs.parentNode.insertBefore(js, fjs);
         }(document, \'script\', \'facebook-jssdk\'));
        </script>';
    }
}

/**
* List object's taxonomy terms
*
* Outputs taxonomy terms assinged to post. Must be used in the loop.
*
* @param $taxomomy (taxonomy)
* @param $fields ('slug', 'name')
* @return string,
* @link https://codex.wordpress.org/Function_Reference/wp_get_object_terms
*/
function taxonomy_terms($taxonomy, $field)
{
    global $wp_query, $post;
    $post = get_post($post->ID);
    $the_terms = wp_get_object_terms($post->ID,  $taxonomy);

    if (!empty($the_terms)) {
        if (! is_wp_error($the_terms)) {
            foreach ($the_terms as $term) {
                echo $term->$field . ' ';
            }
        }
    }
}

/**
* Construct custom post url
*
* Returns event post date in human-readable format
* Example: reimaginebelonging.org/<events-page-slug>/<timeline-term-slug>/<post-slug>/
* @param $date ('start', 'end')
* @return string
*/
function custom_post_url($post_type, $taxonomy = null)
{
    global $wp_query, $post;

    $post = get_post($post->ID);

    // Check if taxonomy is provided
    if($taxonomy !== null) {
        $post_taxonomy_terms    = wp_get_object_terms($post->ID, $taxonomy);
        $taxonomy_term_slug     = $post_taxonomy_terms[0]->slug . '/';
    }
    else {
        $taxonomy_term_slug  = null;
    }

    $site_url               = get_bloginfo('url') . '/';
    $post_name              = $post->post_name . '/';

    switch($post_type) {
        case 'event':
            $base_slug = get_field('event_post_type_slug', 'option') . '/';
            break;
        case 'story':
            $base_slug = get_field('story_post_type_slug', 'option') . '/';
            break;
        case 'workshop':
            $base_slug = get_field('workshop_post_type_slug', 'option') . '/';
            break;
        default:
            $base_slug = null;
            break;
    }

    // Construct URL
    $custom_post_url  = $site_url . $base_slug . $taxonomy_term_slug . $post_name;

    echo $custom_post_url;
}
/**
* Event date
*
* Returns event post date in human-readable format
*
* @param $date ('start', 'end')
* @return string
*/
function event_date($date)
{
    if(get_field('unknown_date') == 0) {
        switch($date) {
            case 'start':
                $start_date_full = get_field('start_date');
                $start_date = date("F jS, Y",strtotime($start_date_full));
                echo $start_date;
                break;
            case 'end':
                if(!empty(get_field('end_date'))) {
                    $end_date_full = get_field('end_date');
                    $end_date = date("F jS, Y",strtotime($end_date_full));
                    echo '— ' . $end_date;
                }
                break;
        }
    }
    else {
        switch($date) {
            case 'start':
                $start_date_full = get_field('start_date');
                $start_date = date("Y",strtotime($start_date_full));
                echo $start_date;
                break;
            case 'end':
                if(!empty(get_field('end_date'))) {
                    $end_date_full = get_field('end_date');
                    $end_date = date("Y",strtotime($end_date_full));
                    echo '— ' . $end_date;
                }
                break;
        }
    }
}
/**
* Get vido embedded code
*
* Returns YouTube/Vimeo embedded vido code based on provided host and ID
*
* @param $host, $id
* @return string
*/
function get_embed_video($host, $id) {
    switch($host) {
        case 'youtube' :
            $object = "<iframe src='https://www.youtube.com/embed/$id?modestbranding=0&nologo=1&iv_load_policy=3&autoplay=0&showinfo=0&controls=1&cc_load_policy=1&rel=0' frameborder='0', allowfullscreen></iframe>";
            echo $object;
            break;
        case 'vimeo' :
            $object = "<iframe src='https://player.vimeo.com/video/$id?title=0&byline=0'></iframe>";
            echo $object;
            break;
    }
}
