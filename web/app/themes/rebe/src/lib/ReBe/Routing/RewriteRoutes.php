<?php namespace ReBe\Routing;

class RewriteRoutes {

    /** Singleton */
    // @codingStandardsIgnoreStart
    private function __construct() {}
    private function __clone() {}
    // @codingStandardsIgnoreEnd

    /**
     * Catches HTTP requests to an entry of a specific post type and based on
     * user agent (defaults to 'browser') rerouts request to a post type base (slug).
     * Necessary for enries dynamic view (i.e. AngularJS app)
     *
     * @param   string    $post_type_slug
     * @param   string    $taxonomy
     * @param   string    $agent
     * @uses UserAgent class
    */
    public static function reroute_posts_to_post_type_base($post_type_slug, $taxonomy = null, $agent = null)
    {
        global $wp;

        $base = "/\b$post_type_slug\b/i";
        $uri  = $_SERVER["REQUEST_URI"];

        if (substr($uri, -1) == '/') {
            $uri = substr($uri, 0, -1);
        }

        $parts = explode('/', rtrim($uri, '/'));

        // Get taxomomy terms slugs
        if (! empty($taxonomy)) {
            $terms = get_terms($taxonomy);
            $slugs = [];

            foreach ($terms as $term) {
                $attribute = (array) $term;
                array_push($slugs, $attribute['slug']);
            }
        }

        // Check if user agent is 'browser' or 'crawler '
        switch($agent){
            case 'crawler':
                $user_agent = UserAgent::check('crawler');
                break;
            default:
                $user_agent = UserAgent::check('browser');
                break;
        }

        // Check all WordPress request against the $post_type_slug
        if (preg_match($base, $wp->request)) {
            // Check user-agent (browser or crawler)
            if ($user_agent) {
                // Construct new URI using post type slug as a base
                if (count($parts) > 2) {
                    setcookie("$post_type_slug", $uri, time()+3600, "/");
                    header('Location: /' . $post_type_slug . '/');
                    exit;
                }
            } else {
                // Construct new URI using post type slug and taxomomy term slug
                if (count($parts) > 2 && in_array($parts[2], $slugs)) {
                    header('Location: /' . $post_type_slug . '/'. $parts[3]);
                    exit;
                }
            }
        }
    }

}
