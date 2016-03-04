<?php namespace WPBasic\Post;

/**
 * Post Type Class used to register post types
 *
 * This class was inspired by Gijs Jorissen 'Cuztoms' post types class
 * @link https://github.com/gizburdt/cuztom/blob/master/classes/post_type.class.php
 *
 * @author 	Ruslan Komjakov
 * @since 	0.1
 *
 */
class PostType
{
    public $name;
    public $label;
    public $title;
    public $plural;
    public $args;
    public $labels;
    public $add_features;
    public $remove_features;

    /**
     * Construct a new Post Type
     *
     * @param 	string        	$name
     * @param 	string|array 	$pretty_name
     * @param 	array 			$args
     * @param 	array 			$labels
     *
     */
    public function __construct($name, $label, $args = [], $labels = [])
    {
        if (! empty($name)) {

            $this->name             = Helper::uglify($name);

            // If $pretty_name is an array, the first element is the singular name, the second is the plural name
            if (is_array($label)) {
                $this->title        = Helper::beautify($label[0]);
                $this->plural       = Helper::beautify($label[1]);
            } else {
                $this->title        = Helper::beautify($label);
                $this->plural       = Helper::pluralize($label);
            }
            $this->args         = $args;
            $this->labels       = $labels;
            $this->add_features = $this->remove_features = [];
            // Add action to register the post type, if the post type doesnt exist
            if (! post_type_exists($this->name)) {
                $this->register_post_type();
            }
        }
    }

    /**
     * Register the Post Type
     */
    public function register_post_type()
    {
        // Set labels
        $labels = array_merge(
            [
                'name'                  => sprintf(_x('%s', 'post type general name', 'rebe'), $this->plural),
                'singular_name'         => sprintf(_x('%s', 'post type singular title', 'rebe'), $this->title),
                'menu_name'             => sprintf(__('%s', 'rebe'), $this->plural),
                'all_items'             => sprintf(__('All %s', 'rebe'), $this->plural),
                'add_new'               => sprintf(_x('Add New', '%s', 'rebe'), $this->title),
                'add_new_item'          => sprintf(__('Add New %s', 'rebe'), $this->title),
                'edit_item'             => sprintf(__('Edit %s', 'rebe'), $this->title),
                'new_item'              => sprintf(__('New %s', 'rebe'), $this->title),
                'view_item'             => sprintf(__('View %s', 'rebe'), $this->title),
                'items_archive'         => sprintf(__('%s Archive', 'rebe'), $this->title),
                'search_items'          => sprintf(__('Search %s', 'rebe'), $this->plural),
                'not_found'             => sprintf(__('No %s found', 'rebe'), $this->plural),
                'not_found_in_trash'    => sprintf(__('No %s found in trash', 'rebe'), $this->plural),
                'parent_item_colon'     => sprintf(__('%s Parent', 'rebe'), $this->title),
                'name_admin_bar'        => sprintf(_x('%s', 'Add New on Toolbar', 'rebe'), $this->title),
                'featured_image'        => sprintf(_x('%s Feature Image', 'Overrides the “Featured Image” phrase for this post type', 'rebe'), $this->title),
                'set_featured_image'    => sprintf(_x('Set feature image', 'Overrides the “Set featured image” phrase for this post type', 'rebe')),
                'remove_featured_image' => sprintf(_x('Remove feature image', 'Overrides the “Remove featured image” phrase for this post type', 'rebe')),
                'use_featured_image'    => sprintf(_x('Use as feature image', 'Overrides the “Use as featured image” phrase for this post type', 'rebe')),
                'archives'              => sprintf(_x('%s archives', 'The post type archive label used in nav menus. Default “Post Archives”', 'rebe'), $this->title),
                'insert_into_item'      => sprintf(_x('Insert into %s', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post)', 'rebe'), $this->title),
                'uploaded_to_this_item' => sprintf(_x('Uploaded to this %s', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase', 'rebe'), $this->title),
                'filter_items_list'     => sprintf(_x('Filter %s list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”', 'rebe'), $this->plural),
                'items_list_navigation' => sprintf(_x('%s list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”', 'rebe'), $this->plural),
                'items_list'            => sprintf(_x('%s list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”', 'rebe'), $this->plural),
            ],
            $this->labels
        );

        // Post type arguments
        $args = array_merge(
            [
                'label'                 => sprintf(__('%s', 'rebe'), $this->plural),
                'labels'                => $labels,
                'public'                => true,
                'supports'              => ['title', 'editor'],
                'has_archive'           => false,
                'show_in_rest'          => true,
                'rest_base'             => $this->plural,
                'rest_controller_class' => 'WP_REST_Posts_Controller',
            ],
            $this->args
        );
        // Register the post type
        register_post_type($this->name, $args);
    }

    /**
     * Add a taxonomy to the Post Type
     *
     * @param 	string       	$name
     * @param 	string|array 	$label
     * @param 	array 			$args
     * @param 	array 			$labels
     * @return  object 			PostType
     *
     */
    public function add_taxonomy($name, $label, $args = [], $labels = [])
    {
        // Call Taxonomy class with this post type name as third parameter
        $taxonomy = new Taxonomy($name, $label, $this->name, $args, $labels);
        // For method chaining
        return $this;
    }

    /**
     * Add action to register support of certain features for a post type.
     *
     * @param 	string|array 	$feature 			The feature being added, can be an array of feature strings or a single string
     * @return 	object 			PostType
     *
     * @author 	Abhinav Sood
     * @since 	1.4.3
     *
     */
    public function add_post_type_support($feature)
    {
        add_post_type_support($this->name, $feature);

        // For method chaining
        return $this;
    }

    /**
     * Add action to remove support of certain features for a post type.
     *
     * @param 	string|array 	$features 			The feature being removed, can be an array of feature strings or a single string
     * @return 	object 			PostType
     *
     * @author 	Abhinav Sood
     * @since 	1.4.3
     *
     */
    public function remove_post_type_support($features)
    {
        foreach ((array) $features as $feature) {
            remove_post_type_support($this->name, $feature);
        }

        // For method chaining
        return $this;
    }

    /**
     * Check if post type supports a certain feature
     *
     * @param 	string  		$feature    		The feature to check support for
     * @return  boolean
     *
     * @author 	Abhinav Sood
     * @since 	1.5.3
     *
     */
    public function post_type_supports($feature)
    {
        return post_type_supports($this->name, $feature);
    }
}
