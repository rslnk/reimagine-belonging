<?php namespace ReBe\API;

use ReBe\API\Data\Event;
use ReBe\API\Data\Story;
use ReBe\API\Data\Workshop;
use ReBe\API\Data\Page;
use WP_Query;


/**
 * Builds data based on API endpoint call
 *
 * @return   array
 * @uses     WP_Query
*/
class PostDataConstructor
{

    protected $type;
    protected $post_type;
    protected $data;
    protected $mode;

    public function __construct($type, $data = null, $mode = null) {

        $this->post_type = $type;
        $this->data = $data;
        $this->mode = $mode;

    }

    /**
     * Construct post data output
     * @return array
    */
    public function get_post_data() {

        switch($this->mode) {
            case 'single':
                return $this->post_single($this->post_type, $this->data);;
                break;
            case 'list':
                return $this->post_list($this->post_type, $this->data);;
                break;
            default:
                die('No such mode: ' . $this->mode . '. Use `single` or `list`.');
                break;
        }
    }

    /**
     * Construct list of posts
     *
     * @param $post_type    post type
     * @param $data         post data ('teaser' or 'full')
    */
    public function post_list($post_type, $data) {

        // Initiate WordPress post query
        $wp_query = new WP_Query([
            'post_type' => $this->post_type,
            'posts_per_page' => -1,
            'no_found_rows' => true, // counts posts, remove if pagination required
            'update_post_term_cache' => false, // grabs terms, remove if terms required (category, tag...)
            'update_post_meta_cache' => false, // grabs post meta, remove if post meta required
        ]);

        // Get the posts from the query
        $posts = $wp_query->get_posts();
        $result = [];

        // Loop through the posts
        foreach($posts as $post) {

            $this->post = $post;

            switch($this->data) {
                case 'teaser':
                // SET TYPE $POST var
                $new = self::post_type($post_type);

                $result[] = $this->the_type->teaser();

                // GET TYPE
                    break;
                case 'full':
                    //return $post;
                    break;
                default:
                    die('No such post data: ' . $this->$data . '. Use `teaser` or `full`.');
                    break;
            }

        }

        return $result;

        wp_reset_postdata();
    }

    /**
     * Construct single post data
     *
     * @param $post_type    post type
     * @param $data         post data ('teaser' or 'full')
    */
    public function post_single($post_type, $data) {

        // Get post id or path (slug) from requested URI
        $id = isset($_REQUEST['id']) ? $_REQUEST['id'] : false;
        $path = isset($_REQUEST['path']) ? $_REQUEST['path'] : false;

        if(!$id && !$path) return false;

        // Get post by post ID
        if($id) {
            $post_id = $id;
            $post    = get_post($post_id);
        }
        // Get post by post slug
        else if($path) {
            $args = [
            'name'          => $path,
            'post_type'     => $this->post_type,
            'numberposts'   => 1
            ];
            $posts            = get_posts($args);
            $post             = $posts[0];
        }

        $this->post = $post;

        $result = [];

        switch($this->data) {
            case 'teaser':
                $new = self::post_type($post_type);
                $result[] = $this->the_type->teaser();
                break;
            case 'full':
                $new = self::post_type($post_type);
                $result = $this->the_type->full();
                break;
            default:
                die('No such post data: ' . $this->$data . '. Use `teaser` or `full`.');
                break;
        }

        return $result;

    }

    /**
     * Get post object based on post type
     * @param $post_type    post type
    */
    public function post_type($post_type) {

        switch($this->post_type) {
            case 'event':
                $the_type = new Event($this->post);
                $this->the_type = $the_type;
                break;
            case 'story':
                $the_type = new Story($this->post);
                $this->the_type = $the_type;
                break;
            case 'workshop':
                $the_type = new Workshop($this->post);
                $this->the_type = $the_type;
                break;
            case 'page':
                $the_type = new Page($this->post);
                $this->the_type = $the_type;
                break;
            default:
                die('No such post type: ' . $this->post_type . '. Use `event`, `story`, `workshop`, `page`.');
                break;
        }

    }

}
