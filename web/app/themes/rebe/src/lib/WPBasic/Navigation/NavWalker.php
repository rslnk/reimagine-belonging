<?php namespace WPBasic\Navigation;

use WPBasic\Utils;

/**
* Cleaner walker for wp_nav_menu()
*
* Walker_Nav_Menu (WordPress default) example output:
*   <li id="menu-item-8" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-8"><a href="/">Home</a></li>
*   <li id="menu-item-9" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-9"><a href="/sample-page/">Sample Page</a></l
*
* NavWalker example output:
*   <li class="menu-home"><a href="/">Home</a></li>
*   <li class="menu-sample-page"><a href="/sample-page/">Sample Page</a></li>
*
* You can enable/disable this feature in functions.php (or lib/setup.php if you're using Sage):
* add_theme_support('soil-nav-walker');
*/
class NavWalker extends \Walker_Nav_Menu
{

    private $cpt; // Boolean, is current post a custom post type
    private $archive; // Stores the archive page for current URL

    public function __construct($class_names=null)
    {
        add_filter('nav_menu_css_class', [$this, 'cssClasses'], 10, 2);
        add_filter('nav_menu_item_id', '__return_null');

        $cpt           = get_post_type();
        $this->cpt     = in_array($cpt, get_post_types(['_builtin' => false]));
        $this->archive = get_post_type_archive_link($cpt);

        $this->active_item_class    = $class_names['active_class'];
        $this->dropdown_item_class  = $class_names['dropdown_class'];
        $this->menu_item_class      = $class_names['menu_item_class'];
        $this->menu_sub_item_class  = $class_names['menu_sub_item_class'];
    }

    public function checkCurrent($classes)
    {
        return preg_match('/(current[-_])|$this->active_item_class/', $classes);
    }

    // @codingStandardsIgnoreStart
    public function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        $element->is_subitem = ((!empty($children_elements[$element->ID]) && (($depth + 1) < $max_depth || ($max_depth === 0))));

        if ($element->is_subitem) {
            foreach ($children_elements[$element->ID] as $child) {
                if ($child->current_item_parent || Utils::url_compare($this->archive, $child->url)) {
                    $element->classes[] = $this->active_item_class;
                }
            }
        }

        $element->is_active = (!empty($element->url) && strpos($this->archive, $element->url));

        if ($element->is_active) {
            $element->classes[] = $this->active_item_class;
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
    // @codingStandardsIgnoreEnd

    public function cssClasses($classes, $item)
    {
        $slug = sanitize_title($item->title);

    // Fix core `active` behavior for custom post types
    if ($this->cpt) {
        $classes = str_replace('current_page_parent', '', $classes);

        if (Utils::url_compare($this->archive, $item->url)) {
            $classes[] = $this->active_item_class;
        }
    }

    // Remove most core classes
    $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', $this->active_item_class, $classes);
        $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

    // Re-add core `menu-item` class
    $classes[] = $this->menu_item_class;

    // Re-add core `menu-item-has-children` class on parent elements
    if ($item->is_subitem) {
        $classes[] = $this->menu_sub_item_class;
    }

    // Add `menu-<slug>` class
    $classes[] = $this->menu_item_class . '--' . $slug;

        $classes = array_unique($classes);
        $classes = array_map('trim', $classes);

        return array_filter($classes);
    }
}

/**
* Clean up wp_nav_menu_args
*
* Remove the container
* Remove the id="" on nav menu items
*/
function nav_menu_args($args = '')
{
    $nav_menu_args = [];
    $nav_menu_args['container'] = false;

    if (!$args['items_wrap']) {
        $nav_menu_args['items_wrap'] = '<ul class="%2$s">%3$s</ul>';
    }

    if (!$args['walker']) {
        $nav_menu_args['walker'] = new NavWalker();
    }

    return array_merge($args, $nav_menu_args);
}

add_filter('wp_nav_menu_args', __NAMESPACE__ . '\\nav_menu_args');
add_filter('nav_menu_item_id', '__return_null');
