<?php
/**
 * Custom data
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
//course custom post type

// Register Custom Post Type course
// Post Type Key: course

function create_course_cpt() {

  $labels = array(
    'name' => __( 'Courses', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Course', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Course', 'textdomain' ),
    'name_admin_bar' => __( 'Course', 'textdomain' ),
    'archives' => __( 'Course Archives', 'textdomain' ),
    'attributes' => __( 'Course Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Course:', 'textdomain' ),
    'all_items' => __( 'All Courses', 'textdomain' ),
    'add_new_item' => __( 'Add New Course', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Course', 'textdomain' ),
    'edit_item' => __( 'Edit Course', 'textdomain' ),
    'update_item' => __( 'Update Course', 'textdomain' ),
    'view_item' => __( 'View Course', 'textdomain' ),
    'view_items' => __( 'View Courses', 'textdomain' ),
    'search_items' => __( 'Search Courses', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into course', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this course', 'textdomain' ),
    'items_list' => __( 'Course list', 'textdomain' ),
    'items_list_navigation' => __( 'Course list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Course list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'course', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category','post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-admin-site-alt',
  );
  register_post_type( 'course', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_course_cpt', 0 );


// Register Custom Post Type organization
// Post Type Key: organization
function create_organization_cpt() {
$labels = array(
    'name' => __( 'organization', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'organization', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'organization', 'textdomain' ),
    'name_admin_bar' => __( 'organization', 'textdomain' ),
    'archives' => __( 'organization Archives', 'textdomain' ),
    'attributes' => __( 'organization Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'organization:', 'textdomain' ),
    'all_items' => __( 'All organizations', 'textdomain' ),
    'add_new_item' => __( 'Add New organization', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New organization', 'textdomain' ),
    'edit_item' => __( 'Edit organization', 'textdomain' ),
    'update_item' => __( 'Update organization', 'textdomain' ),
    'view_item' => __( 'View organization', 'textdomain' ),
    'view_items' => __( 'View organizations', 'textdomain' ),
    'search_items' => __( 'Search organizations', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into organization', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this organization', 'textdomain' ),
    'items_list' => __( 'organization list', 'textdomain' ),
    'items_list_navigation' => __( 'organization list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter organization list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'organization', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-welcome-learn-more',
  );
  register_post_type( 'organization', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_organization_cpt', 0 );


//program custom post type

// Register Custom Post Type program
// Post Type Key: program

function create_program_cpt() {

  $labels = array(
    'name' => __( 'Programs', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Program', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Program', 'textdomain' ),
    'name_admin_bar' => __( 'Program', 'textdomain' ),
    'archives' => __( 'Program Archives', 'textdomain' ),
    'attributes' => __( 'Program Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Program:', 'textdomain' ),
    'all_items' => __( 'All Programs', 'textdomain' ),
    'add_new_item' => __( 'Add New Program', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Program', 'textdomain' ),
    'edit_item' => __( 'Edit Program', 'textdomain' ),
    'update_item' => __( 'Update Program', 'textdomain' ),
    'view_item' => __( 'View Program', 'textdomain' ),
    'view_items' => __( 'View Programs', 'textdomain' ),
    'search_items' => __( 'Search Programs', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into program', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this program', 'textdomain' ),
    'items_list' => __( 'Program list', 'textdomain' ),
    'items_list_navigation' => __( 'Program list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Program list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'program', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array('category', 'post_tag'),
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'can_export' => true,
    'has_archive' => true,
    'hierarchical' => false,
    'exclude_from_search' => false,
    'show_in_rest' => true,
    'publicly_queryable' => true,
    'capability_type' => 'post',
    'menu_icon' => 'dashicons-universal-access-alt',
  );
  register_post_type( 'program', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_program_cpt', 0 );


/*
CUSTOM TAXONOMY LAND
*/

add_action( 'init', 'create_organization_taxonomies', 0 );
function create_organization_taxonomies()
{
  // Add new taxonomy
  $labels = array(
    'name' => _x( 'organization', 'taxonomy general name' ),
    'singular_name' => _x( 'organization', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search organizations' ),
    'popular_items' => __( 'Popular organizations' ),
    'all_items' => __( 'All organizations' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit organization' ),
    'update_item' => __( 'Update organization' ),
    'add_new_item' => __( 'Add New organization' ),
    'new_item_name' => __( 'New organization' ),
    'add_or_remove_items' => __( 'Add or remove organizations' ),
    'choose_from_most_used' => __( 'Choose from the most used organizations' ),
    'menu_name' => __( 'Organization' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('organizations',array('post','course','instructor'), array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'organization' ),
    'show_in_rest'          => true,
    'rest_base'             => 'organizations',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus'     => true, 
    'meta_box_cb'           => false,   
  ));
}



add_action( 'init', 'create_province_taxonomies', 0 );
function create_province_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Provinces', 'taxonomy general name' ),
    'singular_name' => _x( 'province', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Provinces' ),
    'popular_items' => __( 'Popular Provinces' ),
    'all_items' => __( 'All Provinces' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Provinces' ),
    'update_item' => __( 'Update province' ),
    'add_new_item' => __( 'Add New province' ),
    'new_item_name' => __( 'New province' ),
    'add_or_remove_items' => __( 'Add or remove Provinces' ),
    'choose_from_most_used' => __( 'Choose from the most used Provinces' ),
    'menu_name' => __( 'Province' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('provinces',array('program','course','organization'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'province' ),
    'show_in_rest'          => true,
    'rest_base'             => 'province',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}

add_action( 'init', 'create_theme_taxonomies', 0 );
function create_theme_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Themes', 'taxonomy general name' ),
    'singular_name' => _x( 'Theme', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Themes' ),
    'popular_items' => __( 'Popular Themes' ),
    'all_items' => __( 'All Themes' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Themes' ),
    'update_item' => __( 'Update theme' ),
    'add_new_item' => __( 'Add New theme' ),
    'new_item_name' => __( 'New theme' ),
    'add_or_remove_items' => __( 'Add or remove Themes' ),
    'choose_from_most_used' => __( 'Choose from the most used Themes' ),
    'menu_name' => __( 'Theme' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('theme',array('program','course','organization'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'theme' ),
    'show_in_rest'          => true,
    'rest_base'             => 'theme',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}

add_action( 'init', 'create_trade_taxonomies', 0 );
function create_trade_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Trades', 'taxonomy general name' ),
    'singular_name' => _x( 'Trade', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Trades' ),
    'popular_items' => __( 'Popular Trades' ),
    'all_items' => __( 'All Trades' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Trades' ),
    'update_item' => __( 'Update trade' ),
    'add_new_item' => __( 'Add New trade' ),
    'new_item_name' => __( 'New trade' ),
    'add_or_remove_items' => __( 'Add or remove Trades' ),
    'choose_from_most_used' => __( 'Choose from the most used Trades' ),
    'menu_name' => __( 'Trade' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('trades',array('program','course',), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'trade' ),
    'show_in_rest'          => true,
    'rest_base'             => 'trade',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}


add_action( 'init', 'create_delivery_taxonomies', 0 );
function create_delivery_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Delivery', 'taxonomy general name' ),
    'singular_name' => _x( 'Delivery', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search delivery' ),
    'popular_items' => __( 'Popular delivery' ),
    'all_items' => __( 'All delivery' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit delivery' ),
    'update_item' => __( 'Update delivery' ),
    'add_new_item' => __( 'Add New delivery' ),
    'new_item_name' => __( 'New delivery' ),
    'add_or_remove_items' => __( 'Add or remove delivery' ),
    'choose_from_most_used' => __( 'Choose from the most used delivery' ),
    'menu_name' => __( 'Delivery' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('delivery',array('program','course'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'delivery' ),
    'show_in_rest'          => true,
    'rest_base'             => 'delivery',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => true,    
  ));
}

add_action( 'init', 'create_program_taxonomies', 0 );
function create_program_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Programs', 'taxonomy general name' ),
    'singular_name' => _x( 'program', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Programs' ),
    'popular_items' => __( 'Popular Programs' ),
    'all_items' => __( 'All Programs' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit Programs' ),
    'update_item' => __( 'Update program' ),
    'add_new_item' => __( 'Add New program' ),
    'new_item_name' => __( 'New program' ),
    'add_or_remove_items' => __( 'Add or remove Programs' ),
    'choose_from_most_used' => __( 'Choose from the most used Programs' ),
    'menu_name' => __( 'program' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('programs',array('course'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'program' ),
    'show_in_rest'          => true,
    'rest_base'             => 'program',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}



