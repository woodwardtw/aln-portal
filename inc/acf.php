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

function aln_registration_fee (){
    if( get_field('basic_course_information')["registration_fee"]){
        $cost = get_field('basic_course_information')["registration_fee"];
        return '$' . number_format($cost, 2) . ' +GST' ;
    } else {
        return 'No fee indicated.';
    }
}

function aln_university(){
    if (get_field('basic_course_information')['university']){
        return get_field('basic_course_information')['university'][0]->name;
    } else {
        return 'No university given.';
    }
}

function aln_engagement_hours(){
    if(get_field('basic_course_information')["learner_engagement_hours"] != null || get_field('basic_course_information')["learner_engagement_hours"] != ''){
        return get_field('basic_course_information')["learner_engagement_hours"] . ' hours';
    } else {
        return 'No hours indicated.';
    }
}

function aln_registration_link(){
     if(get_field('basic_course_information')["psi_registration_page"] != null || get_field('basic_course_information')["psi_registration_page"] != ''){
        return '<a href="' . get_field('basic_course_information')["psi_registration_page"] . '" aria-label="Go to the PSI registration page.">' . get_field('basic_course_information')["psi_registration_page"] . '</a>' ;
    } else {
        return FALSE; //'No link given This is essential for the marketing of your course.'
    }
}

function aln_registration_contact(){
    $title = get_the_title();
    $name = 'N/A';
    $phone = 'N/A';
    $email = 'N/A';
     if (get_field('basic_course_information')["course_contact_name"] != null || get_field('basic_course_information')["course_contact_email"]){
        if (get_field('basic_course_information')["course_contact_name"]){
            $name = get_field('basic_course_information')["course_contact_name"];
        }
        if (get_field('basic_course_information')["course_contact_email"]){
            $email = get_field('basic_course_information')["course_contact_email"];
        } 
        if (get_field('basic_course_information')["course_contact_phone"]){            
         $phone = get_field('basic_course_information')["course_contact_phone"];
        }
        return "Name: {$name}<br>Phone: {$phone}<br>Email: <a href='mailto:{$email}?subject={$title} Course Inquiry'>{$email}</a>";
     }
}

function aln_short_course_description(){
    $description = get_field('short_course_description');
    if ($description){
        return $description;
    } else {
        return 'No description given.';
    }
}

function aln_course_outline(){
    if(get_field('course_outline')['course_outline']){
        return $course_outline = get_field('course_outline')['course_outline'];     
    } else {
        return "No course outline given.";
    }
}

function aln_course_outline_link(){
     $course_link = get_field('course_outline')['full_course_outline_link'];  
     if($course_link){
        return '<a href="' . $course_link . '" class="btn btn-primary">See the full outline</a>';
     } else {
        return 'No link given.';
     }
}

function aln_instructor_image(){
    if(get_field('instructor')['instructor_image']){
       return $instructor_image = get_field('instructor')['instructor_image']['sizes']['thumbnail'];
    }
    else {
        return $instructor_image = get_template_directory_uri() . '/imgs/mystery.png' ;//symbol.jpg
    }
}

function aln_instructor_name(){
    if(get_field('instructor')['instructor_name']){
        return get_field('instructor')['instructor_name'];
    } else {
        return 'Mystery Instructor';
    }
}

function aln_instructor_bio(){
    if(get_field('instructor')['instructor_biography']){
        return get_field('instructor')['instructor_biography'];
    } else {
        return 'Please enter an instructor biography. Understanding who is teaching a course is a key element in marketing the course.';
    }
}


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



add_action( 'init', 'create_university_taxonomies', 0 );
function create_university_taxonomies()
{
  // Add new taxonomy
  $labels = array(
    'name' => _x( 'University', 'taxonomy general name' ),
    'singular_name' => _x( 'University', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Universities' ),
    'popular_items' => __( 'Popular Universities' ),
    'all_items' => __( 'All Universities' ),
    'parent_item' => null,
    'parent_item_colon' => null,
    'edit_item' => __( 'Edit University' ),
    'update_item' => __( 'Update University' ),
    'add_new_item' => __( 'Add New University' ),
    'new_item_name' => __( 'New University' ),
    'add_or_remove_items' => __( 'Add or remove Universities' ),
    'choose_from_most_used' => __( 'Choose from the most used Universities' ),
    'menu_name' => __( 'University' ),
  );

//registers taxonomy specific post types - default is just post
  register_taxonomy('Universities',array('post','course','instructor'), array(
    'hierarchical'          => true,
    'labels'                => $labels,
    'show_ui'               => true,
    'update_count_callback' => '_update_post_term_count',
    'query_var'             => true,
    'rewrite'               => array( 'slug' => 'university' ),
    'show_in_rest'          => true,
    'rest_base'             => 'university',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus'     => false, 
    'meta_box_cb'           => false,   
  ));
}


// Register Custom Post Type people
// Post Type Key: university
function create_university_cpt() {
$labels = array(
    'name' => __( 'University', 'Post Type General Name', 'textdomain' ),
    'singular_name' => __( 'University', 'Post Type Singular Name', 'textdomain' ),
    'menu_name' => __( 'University', 'textdomain' ),
    'name_admin_bar' => __( 'University', 'textdomain' ),
    'archives' => __( 'University Archives', 'textdomain' ),
    'attributes' => __( 'University Attributes', 'textdomain' ),
    'parent_item_colon' => __( 'University:', 'textdomain' ),
    'all_items' => __( 'All Universities', 'textdomain' ),
    'add_new_item' => __( 'Add New University', 'textdomain' ),
    'add_new' => __( 'Add New', 'textdomain' ),
    'new_item' => __( 'New University', 'textdomain' ),
    'edit_item' => __( 'Edit University', 'textdomain' ),
    'update_item' => __( 'Update University', 'textdomain' ),
    'view_item' => __( 'View University', 'textdomain' ),
    'view_items' => __( 'View Universities', 'textdomain' ),
    'search_items' => __( 'Search Universities', 'textdomain' ),
    'not_found' => __( 'Not found', 'textdomain' ),
    'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
    'featured_image' => __( 'Featured Image', 'textdomain' ),
    'set_featured_image' => __( 'Set featured image', 'textdomain' ),
    'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
    'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
    'insert_into_item' => __( 'Insert into university', 'textdomain' ),
    'uploaded_to_this_item' => __( 'Uploaded to this university', 'textdomain' ),
    'items_list' => __( 'University list', 'textdomain' ),
    'items_list_navigation' => __( 'University list navigation', 'textdomain' ),
    'filter_items_list' => __( 'Filter university list', 'textdomain' ),
  );
  $args = array(
    'label' => __( 'university', 'textdomain' ),
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
  register_post_type( 'university', $args );
  
  // flush rewrite rules because we changed the permalink structure
  global $wp_rewrite;
  $wp_rewrite->flush_rules();
}
add_action( 'init', 'create_university_cpt', 0 );


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
  register_taxonomy('provinces',array('post','program','course','university'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'province' ),
    'show_in_rest'          => true,
    'rest_base'             => 'province',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_theme_taxonomies', 0 );
function create_theme_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Themes', 'taxonomy general name' ),
    'singular_name' => _x( 'theme', 'taxonomy singular name' ),
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
  register_taxonomy('theme',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'theme' ),
    'show_in_rest'          => true,
    'rest_base'             => 'theme',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

add_action( 'init', 'create_trade_taxonomies', 0 );
function create_trade_taxonomies()
{
  // Add new taxonomy, NOT hierarchical (like tags)
  $labels = array(
    'name' => _x( 'Trades', 'taxonomy general name' ),
    'singular_name' => _x( 'trade', 'taxonomy singular name' ),
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
  register_taxonomy('trades',array('post'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => false,
    'update_count_callback' => '_update_post_term_count',
    'query_var' => true,
    'rewrite' => array( 'slug' => 'trade' ),
    'show_in_rest'          => true,
    'rest_base'             => 'trade',
    'rest_controller_class' => 'WP_REST_Terms_Controller',
    'show_in_nav_menus' => false,    
  ));
}

