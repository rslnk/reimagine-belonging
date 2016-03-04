<?php namespace App;

use Roots\Sage\Asset;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\WrapperCollection;
use Roots\Sage\Template\WrapperInterface;
use ReBe\Redirects\UserAgents;

/**
 * @param WrapperInterface $wrapper
 * @param string $slug
 * @return string
 * @throws \Exception
 * @SuppressWarnings(PHPMD.StaticAccess) This is a helper function, so we can suppress this warning
 */
function template_wrap(WrapperInterface $wrapper, $slug = 'base')
{
    WrapperCollection::add($wrapper, $slug);
    return $wrapper->getWrapper();
}

/**
 * @param string $slug
 * @return string
 */
function template_unwrap($slug = 'base')
{
    return WrapperCollection::get($slug)->getTemplate();
}

/**
 * @param $filename
 * @return string
 */
function asset_path($filename)
{
    static $manifest;
    isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/' . Asset::$dist . '/assets.json');
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
        $app_id   = get_field('facebook_app_id', 'option');
        $language = get_field('site_language', 'option');
        echo '<div id="fb-root"></div>';
        echo '<script>(function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return; js = d.createElement(s);
      js.id = id; js.src = "//connect.facebook.net/'
      . $language . '/sdk.js#xfbml=1&version=v2.3&appId='
      . $app_id . '"; fjs.parentNode.insertBefore(js, fjs); }
      (document, \'script\', \'facebook-jssdk\'));</script>';
    }
}

/**
* List object's taxonomy terms
*
* Outputs post taxonomy terms as a list (no links)
*
* @return string,
* @link http://codex.wordpress.org/Function_Reference/get_the_terms
*/
function list_categories()
{
    global $wp_query, $post;
    // get post by post id
    $post = get_post($post->ID);
    // get post type by post
    $post_type = $post->post_type;
    // get post type taxonomies
    $taxonomies = get_object_taxonomies($post_type, 'objects');

    $out = [];
    foreach ($taxonomies as $taxonomy_slug => $taxonomy) {
        // get the terms related to post
        $terms = get_the_terms($post->ID, $taxonomy_slug);
        if (!empty($terms)) {
            $out[] = '<ul class="c-categories-chain c-categories-chain--event">';
            foreach ($terms as $term) {
                $out[] =
                '<li class="c-categories-chain__item o-btn c-btn--small c-btn--indigo">'
                . $term->name
                . '</li>';
            }
            $out[] = "</ul>";
        }
    }
    echo implode('', $out);
}
