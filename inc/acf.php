<?php
/**
 * ACF Functions and CPTs
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;


//from https://whiteleydesigns.com/modify-post-title-post-content-labels-front-end-acf-form/
// Modify ACF Form Label for Post Title Field
function aln_post_title_acf_name( $field ) {
   
    $field['label'] = 'Course Name';
    return $field;
}
add_filter('acf/load_field/name=_post_title', 'aln_post_title_acf_name');


//ACF SAVE and LOAD JSON
add_filter('acf/settings/save_json', 'alt_ee_json_save_point');
 
function alt_ee_json_save_point( $path ) {
    
    // update path
    $path = get_stylesheet_directory() . '/acf-json';
    // return
    return $path;
    
}


add_filter('acf/settings/load_json', 'alt_ee_json_load_point');

function alt_ee_json_load_point( $paths ) {
    
    // remove original path (optional)
    unset($paths[0]);
    
    // append path
    $paths[] = get_stylesheet_directory()  . '/acf-json';
    
    
    // return
    return $paths;
    
}



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


//instructor custom post type

// Register Custom Post Type instructor
// Post Type Key: instructor

function create_instructor_cpt() {

  $labels = array(
    'name' => __( 'Instructors', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'Instructor', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'Instructor', 'textdomain' ),
    'name_admin_bar' => __( 'Instructor', 'textdomain' ),
    'archives' => __( 'Instructor Archives', 'textdomain' ),
    'attributes' => __( 'Instructor Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'Instructor:', 'textdomain' ),
    'all_items' => __( 'All Instructors', 'textdomain' ),
    'add_new_item' => __( 'Add New Instructor', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New Instructor', 'textdomain' ),
    'edit_item' => __( 'Edit Instructor', 'textdomain' ),
    'update_item' => __( 'Update Instructor', 'textdomain' ),
    'view_item' => __( 'View Instructor', 'textdomain' ),
    'view_items' => __( 'View Instructors', 'textdomain' ),
    'search_items' => __( 'Search Instructors', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into instructor', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this instructor', 'textdomain' ),
    'items_list' => __( 'Instructor list', 'textdomain' ),
    'items_list_navigation' => __( 'Instructor list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter Instructor list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'instructor', 'textdomain' ),
    'description' => __( '', 'textdomain' ),
    'labels' => $labels,
    'menu_icon' => '',
    'supports' => array('title', 'editor', 'revisions', 'author', 'trackbacks', 'custom-fields', 'thumbnail',),
    'taxonomies' => array(),
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
  register_post_type( 'instructor', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_instructor_cpt', 0 );