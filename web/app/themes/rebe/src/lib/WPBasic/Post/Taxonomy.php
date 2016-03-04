<?php namespace WPBasic\Post;;

use WPBasic\Utils;

/**
 * Class used to register custom taxonomies
 *
 * This class was inspired by Gijs Jorissen 'Cuztoms' post taxonomy class
 * @link https://github.com/gizburdt/cuztom/blob/master/classes/taxonomy.class.php
 *
 * @author  Ruslan Komjakov
 * @since 	0.1
 *
 */
class Taxonomy
{
    public $name;
    public $label;
    public $title;
    public $plural;
    public $labels;
    public $args;
    public $post_type;

    /**
     * Constructs the class with important vars and method calls
     * If the taxonomy exists, it will be attached to the post type
     *
     * @param 	string 			$name
     * @param 	string|array    $label
     * @param 	string          $post_type
     * @param 	array 			$args
     * @param 	array 			$labels
     *
     */
    public function __construct($name, $label, $post_type = null, $args = [], $labels = [])
    {
        if (! empty($name)) {
            $this->post_type = (array) $post_type;
            $this->name = Helper::uglify($name);
            if (is_array($label)) {
                $this->title        = Helper::beautify($label[0]);
                $this->plural       = Helper::beautify($label[1]);
            } else {
                $this->title        = Helper::beautify($label);
                $this->plural       = Helper::pluralize($label);
            }
            $this->labels = $labels;
            $this->args   = $args;

            if (! taxonomy_exists($this->name)) {
                if ($is_reserved_term = Helper::is_reserved_term($this->name)) {
                    new Notice($is_reserved_term->get_error_message(), 'error');
                } else {
                    $this->register_taxonomy();
                }
            } else {
                $this->register_taxonomy_for_object_type();
            }
            if (isset($args['show_admin_column']) && $args['show_admin_column']) {
                foreach ($this->post_type as $post_type) :
                    if (get_bloginfo('version') < '3.5') {
                        add_filter('manage_' . $post_type . '_posts_columns', [&$this, 'add_column']);
                        add_action('manage_' . $post_type . '_posts_custom_column', [&$this, 'add_column_content'], 10, 2);
                    }
                if (isset($args['admin_column_sortable']) && $args['admin_column_sortable']) {
                    add_action('manage_edit-' . $post_type . '_sortable_columns', [&$this, 'add_sortable_column'], 10, 2);
                }
                endforeach;
                if (isset($args['admin_column_filter']) && $args['admin_column_filter']) {
                    add_action('restrict_manage_posts', [&$this, '_post_filter']);
                    add_filter('parse_query', [&$this, '_post_filter_query']);
                }
            }
        }
    }

    /**
     * Registers the custom taxonomy with the given arguments
     */
    public function register_taxonomy()
    {

        // Default labels, overwrite them with the given labels.
        $labels = array_merge(
            [
                'name'                       => sprintf(_x('%s', 'taxonomy general name', 'rebe'), $this->plural),
                'singular_name'              => sprintf(_x('%s', 'taxonomy singular name', 'rebe'), $this->title),
                'search_items'               => sprintf(__('Search %s', 'rebe'), $this->plural),
                'popular_items'              => sprintf(__('Popular %s', 'rebe'), $this->plural),
                'all_items'                  => sprintf(__('All %s', 'rebe'), $this->plural),
                'parent_item'                => sprintf(__('Parent %s', 'rebe'), $this->title),
                'parent_item_colon'          => sprintf(__('Parent %s:', 'rebe'), $this->title),
                'edit_item'                  => sprintf(__('Edit %s', 'rebe'), $this->title),
                'update_item'                => sprintf(__('Update %s', 'rebe'), $this->title),
                'add_new_item'               => sprintf(__('Add New %s', 'rebe'), $this->title),
                'new_item_name'              => sprintf(__('New %s Name', 'rebe'), $this->title),
                'separate_items_with_commas' => sprintf(__('Separate %s with commas', 'rebe'), $this->plural),
                'add_or_remove_items'        => sprintf(__('Add or remove %s writers', 'rebe'), $this->plural),
                'choose_from_most_used'      => sprintf(__('Choose from the most used', 'rebe'), $this->plural),
                'not_found'                  => sprintf(__('No %s found.', 'rebe'), $this->plural),
                'menu_name'                  => sprintf(__('%s', 'rebe'), $this->plural),
                'no_terms'                   => sprintf(__('No %s', 'rebe'), $this->plural),
                'items_list_navigation'      => sprintf(__('%s list navigation', 'rebe'), $this->plural),
                'items_list'                 => sprintf(__('%s list', 'rebe'), $this->plural),
                'show_in_rest'               => true,
                'rest_base'                  => $this->plural,
                'rest_controller_class'      => 'WP_REST_Posts_Controller',
            ],
            $this->labels
        );
        // Default arguments, overwitten with the given arguments
        $args = array_merge(
            [
                'label'                 => sprintf(__('%s', 'rebe'), $this->plural),
                'labels'                => $labels,
                'hierarchical'          => false,
                'public'                => true,
                'show_ui'               => true,
                'show_in_nav_menus'     => true,
                '_builtin'              => false,
                'show_admin_column'     => false
            ],
            $this->args
        );

        register_taxonomy($this->name, $this->post_type, $args);
    }

    /**
     * Used to attach the existing taxonomy to the post type
     *
     * @author 	Gijs Jorissen
     * @since 	0.2
     *
     */
    public function register_taxonomy_for_object_type()
    {
        register_taxonomy_for_object_type($this->name, $this->post_type);
    }

    /**
     * Used to add a column head to the Post Type's List Table
     *
     * @param 	array 			$columns
     * @return 	array
     *
     * @author 	Gijs Jorissen
     * @since 	1.6
     *
     */
    public function add_column($columns)
    {
        unset($columns['date']);
        $columns[$this->name] = $this->title;
        $columns['date'] = __('Date', 'rebe');

        return $columns;
    }

    /**
     * Used to add the column content to the column head
     *
     * @param 	string 			$column
     * @param 	integer 		$post_id
     * @return 	mixed
     *
     * @author 	Gijs Jorissen
     * @since 	1.6
     *
     */
    public function add_column_content($column, $post_id)
    {
        if ($column === $this->name) {
            $terms = wp_get_post_terms($post_id, $this->name, ['fields' => 'names']);
            echo implode($terms, ', ');
        }
    }

    /**
     * Used to make all columns sortable
     *
     * @param 	array 			$columns
     * @return  array
     *
     * @author  Gijs Jorissen
     * @since   1.6
     *
     */
    public function add_sortable_column($columns)
    {
        $columns[(get_bloginfo('version') < '3.5') ? $this->name : 'taxonomy-' . $this->name] = $this->title;
        return $columns;
    }

    /**
     * Adds a filter to the post table filters
     *
     * @author 	Gijs Jorissen
     * @since 	1.6
     *
     */
    public function _post_filter()
    {
        global $typenow, $wp_query;
        if (in_array($typenow, $this->post_type)) {
            wp_dropdown_categories([
                'show_option_all'       => sprintf(__('Show all %s', 'rebe'), $this->plural),
                'taxonomy'              => $this->name,
                'name'                  => $this->name,
                'orderby'               => 'name',
                'selected'              => isset($wp_query->query[$this->name]) ? $wp_query->query[$this->name] : '',
                'hierarchical'          => true,
                'show_count'            => true,
                'hide_empty'            => true,
            ]);
        }
    }

    /**
     * Applies the selected filter to the query
     *
     * @param 	object 			$query
     *
     * @author  Gijs Jorissen
     * @since  	1.6
     *
     */
    public function _post_filter_query($query)
    {
        global $pagenow;
        $vars = &$query->query_vars;
        if ($pagenow == 'edit.php' && isset($vars[$this->name]) && is_numeric($vars[$this->name]) && $vars[$this->name]) {
            $term = get_term_by('id', $vars[$this->name], $this->name);
            $vars[$this->name] = $term->slug;
        }
        return $vars;
    }
}
