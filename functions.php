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
	'/editor.php',                          // Load Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	'/acf.php',                             // Load ACF functions.
);

foreach ( $understrap_includes as $file ) {
	require_once get_template_directory() . '/inc' . $file;
}


function aln_show_courses(){
  $html = "";
  $args = array(
      'posts_per_page' => 18,
      'post_type'   => 'course', 
      'post_status' => 'publish', 
      'nopaging' => false,
                    );
    $i = 0;
    $the_query = new WP_Query( $args );
        if( $the_query->have_posts() ): 
          while ( $the_query->have_posts() ) : $the_query->the_post();
                   echo '<div class="col-md-12"><h2>' . get_the_title() . '</h2></div>';   
           endwhile;
      endif;
    wp_reset_query();  // Restore global post data stomped by the_post().
   //return '<div class="row topic-wrapper">' . $html . '</div>';
}

add_shortcode( 'show-courses', 'aln_show_courses' );


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
        	 return home_url();
        } else {
        	return admin_url();
        }
    }
}
add_filter( 'login_redirect', 'aln_login_redirect', 10, 3 );