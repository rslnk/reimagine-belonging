<?

/*

  # Taxonomies

  Event Timeline:      event_timeline
  Event Era:           event_era
  Event Type:          event_type
  Event Group:         event_group
  Event Topic:         event_topic

  Story Topic:         story_topic
  Story City:          story_city
  Story Hero:          story_hero
  Story Group:         story_group

  Shared Tags:         global_tag

  ## Taxomomy archives

  By default all custom taxonomies used for events and stories post typse are private,
  which means taxonimies are used internally by the app, but do not generate their own URL.

  In order to make taxonimies publicly accessible change 'public' and 'rewrite' parameter to true.
  Make sure that taxonimies are using desired slugs!

  Note: Having identical slugs for post types and their taxonomies will result in 'page not found' error.

*/

add_action( 'init', __NAMESPACE__ . '\\register_taxonomies' );

function register_taxonomies() {

  // Event Timeline

  $taxonomy       = 'event_timeline';
  $slug           = 'timelines';
  $post_types     = 'event';

  $plural         = 'Timelines';
  $singular       = 'Timeline';

  $labels = [
    'name'                        => __( $plural ),
    'singular_name'               => __( $singular ),
    'search_items'                => __( 'Search ' . $plural ),
    'all_items'                   => __( 'All ' . $plural ),
    'parent_item'                 => __( 'Parent ' . $singular ),
    'parent_item_colon'           => __( 'Parent ' . $singular .':' ),
    'edit_item'                   => __( 'Edit ' . $singular  ),
    'update_item'                 => __( 'Update ' . $singular ),
    'add_new_item'                => __( 'Add New ' . $singular ),
    'new_item_name'               => __( 'New ' . $singular ),
    'menu_name'                   => __( $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => true,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true, 'hierarchical'=> true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Era
  // Note: this taxonomy is for internal use only and it is not publicly queryable.

  $taxonomy       = 'event_era';
  $slug           = 'eras';
  $post_types     = 'event';

  $singular       = 'Era';
  $plural         = 'Eras';

  $labels = [
    'name'                        => __( $plural ),
    'singular_name'               => __( $singular ),
    'search_items'                => __( 'Search ' . $plural ),
    'all_items'                   => __( 'All ' . $plural ),
    'parent_item'                 => __( 'Parent ' . $singular ),
    'parent_item_colon'           => __( 'Parent ' . $singular .':' ),
    'edit_item'                   => __( 'Edit ' . $singular  ),
    'update_item'                 => __( 'Update ' . $singular ),
    'add_new_item'                => __( 'Add New ' . $singular ),
    'new_item_name'               => __( 'New ' . $singular ),
    'menu_name'                   => __( $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => false,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Type

  $taxonomy       = 'event_type';
  $slug           = 'types';
  $post_types     = 'event';

  $singular       = 'Type';
  $plural         = 'Types';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => false,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Topic

  $taxonomy       = 'event_topic';
  $slug           = 'topics';
  $post_types     = 'event';

  $singular       = 'Topic';
  $plural         = 'Topics';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => true,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Event Group

  $taxonomy       = 'event_group';
  $slug           = 'groups';
  $post_types     = 'event';

  $singular       = 'Group';
  $plural         = 'Groups';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => false,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story Topic

  $taxonomy       = 'story_topic';
  $slug           = 'topics';
  $post_types     = 'story';

  $singular       = 'Topic';
  $plural         = 'Topics';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story City

  $taxonomy       = 'story_city';
  $slug           = 'cities';
  $post_types     = 'story';

  $singular       = 'City';
  $plural         = 'Cities';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => false,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story Hero

  $taxonomy       = 'story_person';
  $slug           = 'people';
  $post_types     = 'story';

  $singular       = 'Person';
  $plural         = 'People';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Story Group

  $taxonomy       = 'story_group';
  $slug           = 'groups';
  $post_types     = 'story';

  $singular       = 'Group';
  $plural         = 'Groups';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => true,

    'hierarchical'                => false,
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => false, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );


  // Global Tag
  // Note: this taxonomy is shared beetween event and story post types

  $taxonomy       = 'global_tag';
  $slug           = 'tags';
  $post_types     = ['event', 'story'];

  $singular       = 'Tag';
  $plural         = 'Tags';

  $labels = [
    'name'                       => __( $plural ),
    'singular_name'              => __( $singular ),
    'search_items'               => __( 'Search ' . $plural ),
    'popular_items'              => __( 'Popular ' . $plural ),
    'all_items'                  => __( 'All ' . $plural ),
    'parent_item'                => null,
    'parent_item_colon'          => null,
    'edit_item'                  => __( 'Edit ' . $singular  ),
    'update_item'                => __( 'Update ' . $singular  ),
    'add_new_item'               => __( 'Add New ' . $singular ),
    'new_item_name'              => __( 'Add New ' . $singular . ' Name'),
    'separate_items_with_commas' => __( 'Separate ' . $plural . ' with commas' ),
    'add_or_remove_items'        => __( 'Add or remove ' . $plural . ' writers' ),
    'choose_from_most_used'      => __( 'Choose from the most used ' . $plural ),
    'not_found'                  => __( 'No ' . $plural  .' found.' ),
    'menu_name'                  => __(  $plural ),
  ];

  $args = [
    'labels'                      => $labels,

    'public'                      => false,
    'show_ui'                     => true,
    'show_in_nav_menus'           => false,
    'meta_box_cb'                 => false, // hide meta box on post edit page
    'show_admin_column'           => false,

    'hierarchical'                => false,
    'update_count_callback'       => '_update_post_term_count',
    'rewrite'                     => false, //['slug' => $slug, 'with_front' => true],
    'sort'                        => true, // whether taxonomy should remember the order in which terms are added to objects
  ];

  register_taxonomy( $taxonomy, $post_types, $args );
}
