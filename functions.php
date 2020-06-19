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
