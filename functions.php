<?php
/**
 * UnderStrap functions and definitions
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/jetpack.php',                         // Load Jetpack compatibility file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/woocommerce.php',                     // Load WooCommerce functions.
	'/editor.php',  
  '/custom-data.php',                      // Load cpts and taxonomies.
	'/deprecated.php',                      // Load deprecated functions.
	'/acf.php',                             // Load ACF functions.
);

foreach ( $understrap_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}


// function aln_show_courses(){
//   $html = "";
//   $args = array(
//       'posts_per_page' => 18,
//       'post_type'   => 'course', 
//       'post_status' => 'publish', 
//       'nopaging' => false,
//                     );
//     $i = 0;
//     $the_query = new WP_Query( $args );
//         if( $the_query->have_posts() ): 
//           while ( $the_query->have_posts() ) : $the_query->the_post();
//                    echo '<div class="col-md-12"><h2>' . get_the_title() . '</h2></div>';   
//            endwhile;
//       endif;
//     wp_reset_query();  // Restore global post data stomped by the_post().
//    //return '<div class="row topic-wrapper">' . $html . '</div>';
// }

// add_shortcode( 'show-courses', 'aln_show_courses' );


//create user type ALN AUTHOR
function aln_update_custom_roles() {
    if ( get_option( 'custom_roles_version' ) < 1 ) {
        add_role( 'aln_author', 'ALN Author', get_role( 'author' )->capabilities  );
        update_option( 'custom_roles_version', 1 );
    }
}
add_action( 'init', 'aln_update_custom_roles' );

function aln_get_current_user_roles() {
 if( is_user_logged_in() ) {
   $user = wp_get_current_user();
   $roles = ( array ) $user->roles;
   return $roles; // This returns an array
   // Use this to return a single value
   // return $roles[0];
 } else {
 return array();
 }
}




//restrict posts to  author level to only the posts they wrote
function aln_posts_for_current_author($query) {
    global $pagenow;
 
    if( 'edit.php' != $pagenow || !$query->is_admin )
        return $query;
 
    if( !current_user_can( 'manage_options' ) ) {
        global $user_ID;
        $query->set('author', $user_ID );
    }
    return $query;
}
add_filter('pre_get_posts', 'aln_posts_for_current_author');


add_action('after_setup_theme', 'aln_remove_admin_bar');
 
function aln_remove_admin_bar() {
	if (!current_user_can('administrator') && !is_admin()) {
		  show_admin_bar(false);
		}
	}


//redirect aln authors
function aln_login_redirect( $redirect_to, $request, $user ) {
    //is there a user to check?
    global $user;
    if ( isset( $user->roles ) && is_array( $user->roles ) ) {

        if ( in_array( 'aln_author', $user->roles ) ) {
        	 return home_url().'/all-courses/';
        } else {
        	return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'aln_login_redirect', 10, 3 );



//get the quotes for the front page
function aln_list_courses($atts){  
  $a = shortcode_atts( array(
    'university' => '',
  ), $atts );

  
  $html = "<ul>";
  $args = array(
      'posts_per_page' => 30,      
      'post_type'   => 'course', 
      'post_status' => 'publish', 
      'order' => 'ASC',
      'orderby' => 'name',  
      'nopaging' => false,                                        
                    );

	  if ($a['university']) {
	    $args['tax_query'] = array( // (array) - use taxonomy parameters (available with Version 3.1).
			    'relation' => 'AND', // (string) - The logical relationship between each inner taxonomy array when there is more than one. Possible values are 'AND', 'OR'. Do not use with a single inner taxonomy array. Default value is 'AND'.
			    array(
			      'taxonomy' => 'Universities', // (string) - Taxonomy.
			      'field' => 'name', // (string) - Select taxonomy term by Possible values are 'term_id', 'name', 'slug' or 'term_taxonomy_id'. Default value is 'term_id'.
			      'terms' => array( $a['university'] ), // (int/string/array) - Taxonomy term(s).
			      'include_children' => false, // (bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
			      'operator' => 'IN' // (string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND', 'EXISTS' and 'NOT EXISTS'. Default value is 'IN'.
			    )
			  );
	  } 

    $the_query = new WP_Query( $args );
    //print("<pre>".print_r($the_query,true)."</pre>");
                    if( $the_query->have_posts() ): 
                      while ( $the_query->have_posts() ) : $the_query->the_post(); 
                        $post_id = get_the_ID();
                        if( have_rows('dates', $post_id) ):
                          while( have_rows('dates', $post_id) ): the_row();
                            $html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . ' - ' . get_sub_field('course_start_date', $post_id) . '</a></li>';  
                          endwhile;
                        else :
                          ($html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . ' - no date</a></li>');
                        endif;
                      endwhile;
                      else :
                      ( $html .= '<li>No courses entered yet.</li>' );
                  endif;

            wp_reset_query();  // Restore global post data stomped by the_post().
   return $html . '</ul>';


}

add_shortcode( 'list-courses', 'aln_list_courses' );




//get the quotes for the front page
function aln_list_unique_courses($atts){  
  $a = shortcode_atts( array(
    'university' => '',
  ), $atts );

  
  $html = "<ul>";
  $args = array(
      'posts_per_page' => 30,      
      'post_type'   => 'course', 
      'post_status' => 'publish', 
      'order' => 'ASC',
      'orderby' => 'name',  
      'nopaging' => false,                                        
                    );

    if ($a['university']) {
      $args['tax_query'] = array( // (array) - use taxonomy parameters (available with Version 3.1).
          'relation' => 'AND', // (string) - The logical relationship between each inner taxonomy array when there is more than one. Possible values are 'AND', 'OR'. Do not use with a single inner taxonomy array. Default value is 'AND'.
          array(
            'taxonomy' => 'Universities', // (string) - Taxonomy.
            'field' => 'name', // (string) - Select taxonomy term by Possible values are 'term_id', 'name', 'slug' or 'term_taxonomy_id'. Default value is 'term_id'.
            'terms' => array( $a['university'] ), // (int/string/array) - Taxonomy term(s).
            'include_children' => false, // (bool) - Whether or not to include children for hierarchical taxonomies. Defaults to true.
            'operator' => 'IN' // (string) - Operator to test. Possible values are 'IN', 'NOT IN', 'AND', 'EXISTS' and 'NOT EXISTS'. Default value is 'IN'.
          )
        );
    } 

    $the_query = new WP_Query( $args );
    //print("<pre>".print_r($the_query,true)."</pre>");
                    if( $the_query->have_posts() ): 
                      while ( $the_query->have_posts() ) : $the_query->the_post(); 
                        $post_id = get_the_ID();                        
                          ($html .= '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>');
                      endwhile;
                      else :
                      ( $html .= '<li>No courses entered yet.</li>' );
                  endif;

            wp_reset_query();  // Restore global post data stomped by the_post().
   return $html . '</ul>';

            

}

add_shortcode( 'list-unique-courses', 'aln_list_unique_courses' );


//stop media library stuff

// Conditionally don't load the Media Library tab/ content
function aln_remove_medialibrary_tab($strings) {
  if ( !current_user_can('administrator')  ) {
    unset($strings["mediaLibraryTitle"]);
    return $strings;
  } else {
    return $strings;
  }
}
add_filter('media_view_strings','aln_remove_medialibrary_tab');

// Conditionally don't run the Media Library's initializing AJAX
function aln_restrict_non_admins(){
  if( !current_user_can('administrator') ){
    exit;
  }
}
add_action('wp_ajax_query-attachments','aln_restrict_non_admins',1);
add_action('wp_ajax_nopriv_query-attachments','aln_restrict_non_admins',1);




//send email on form submission

add_action('acf/save_post', 'aln_course_email');

function aln_course_email( $post_id ) {  
  
  // bail early if editing in admin
  if( is_admin() ) {
    return;
  }
  
  // vars
  $post = get_post( $post_id );
  
  
  // get custom fields (field group exists for content_form)

  $author_id = $post->post_author;
  $email = get_the_author_meta('email', $author_id);
  // email data
  $to = $email;
  $headers = 'From: Adaption Learning Network Portal <climateaction@royalroads.ca>' . "\r\n";
  $subject = 'A link to your recent course creation - ' . $post->post_title;
  $body = 'You can always return directly to this link to add to or update this course information. If you lose this email, just return to the ALN Portal site and find your course in the "All Courses" page. ' . get_post_permalink($post_id);
  
  
  // send email
  wp_mail($to, $subject, $body, $headers );
  
}


//CREATE CUSTOM COURSE IMAGE SIZE
add_image_size( 'course-image', 560, 315, true );

//560x315

add_action('acf/save_post', 'aln_course_org_as_cat');

function aln_course_org_as_cat($post_id){
  if(get_field('organization')){
      $orgs = get_field('organization');
      //write_log($orgs);
      $cats = array();
      foreach ($orgs as $org){
          $org_slug = $org->post_name;
          if(get_term_by( 'slug', $org_slug, 'organizations')){
            //$cat = get_category_by_slug($org_slug);  
            $cat = get_term_by( 'slug', $org_slug, 'organizations');

            //write_log($cat->term_id);
            array_push($cats, $cat->term_id);
          } else {
            $new_cat = wp_insert_term( $org->post_title, 'organizations' );
            //write_log($new_cat);
            array_push($cats, $new_cat);
          }
                  
      } 
      //wp_set_post_categories( $post_id, $cats, false);
      wp_set_post_terms( $post_id, $cats, 'organizations', false );

  }
}

add_action('acf/save_post', 'aln_course_program_as_cat');

function aln_course_program_as_cat($post_id){
  if(get_field('program')){
      $orgs = get_field('program');
      //write_log($orgs);
      $cats = array();
      foreach ($orgs as $org){
          $org_slug = $org->post_name;
          if(get_term_by( 'slug', $org_slug, 'programs')){
            //$cat = get_category_by_slug($org_slug);  
            $cat = get_term_by( 'slug', $org_slug, 'programs');

            //write_log($cat->term_id);
            array_push($cats, $cat->term_id);
          } else {
            $new_cat = wp_insert_term( $org->post_title, 'programs' );
            //write_log($new_cat);
            array_push($cats, $new_cat);
          }
                  
      } 
      //wp_set_post_categories( $post_id, $cats, false);
      wp_set_post_terms( $post_id, $cats, 'programs', false );

  }
}



//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}
